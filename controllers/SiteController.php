<?php

namespace app\controllers;

use app\models\PasswordResetRequestForm;
use app\modules\curriculum\models\CurriculumSearch;
use app\modules\curriculum\models\Event;
use app\modules\group\models\Group;
use Cassandra\Date;
use DateTime;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function beforeAction($action): bool
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;

            if ($role === 'banned') {
                throw new ForbiddenHttpException('Вам запрещен доступ к сайту.');
            }
        }

        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'logout', 'calendar'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index', 'calendar', 'events'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'events' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new CurriculumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'models' => $dataProvider->models,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionResetPassword(): Response|string
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось отправить письмо для сброса пароля.');
            }
        }

        return $this->render('reset-password', [
            'model' => $model,
        ]);
    }

    public function actionCalendar(): string
    {
        return $this->render('calendar');
    }

    public function actionEvents(): array
    {
        $events = [];
        $eventsModel = [];

        foreach (Yii::$app->user->identity->groups as $group) {
            foreach ($group->curriculums as $curriculum) {
                foreach ($curriculum->events as $event) {
                    $eventsModel[] = $event;
                }
            }
        }

        foreach ($eventsModel as $eventModel) {
            if (empty($eventModel->startDate)) continue;
            $date = (new DateTime($eventModel->startDate))->format(('Y-m-d\TH:i:s\Z'));
            $events[] = [
                'title' => $eventModel->title,
                'start' => $date,
                'url' => Url::to(['curriculum/event/view', 'id' => $eventModel->id]),
            ];
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $events;
    }
    public function actionTest()
    {
/*        // Назначаем роли и разрешения
        $auth = Yii::$app->authManager;

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        $studentRole = $auth->createRole('student');
        $auth->add($studentRole);

        $teacherRole = $auth->createRole('teacher');
        $auth->add($teacherRole);

        // Назначаем разрешения
        $manageUsersPermission = $auth->createPermission('manageUsers');
        $auth->add($manageUsersPermission);

        // Связываем разрешения с ролями
        $auth->addChild($adminRole, $manageUsersPermission);

        // Назначаем роли пользователям
        $auth->assign($adminRole, 1);*/

        return '123';
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
