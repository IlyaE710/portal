<?php

namespace app\modules\profile\controllers;

use app\models\User;
use app\modules\profile\models\UserCreateForm;
use app\modules\profile\models\UserSearch;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProfileController implements the CRUD actions for User model.
 */
class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'roles' => ['banned'],
                        'denyCallback' => function ($rule, $action) {
                            throw new ForbiddenHttpException('Вы заблокированы!');
                        }
                    ],
                    [
                        'actions' => ['index', 'create', 'create-user', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateUser()
    {
        $form = new UserCreateForm();
        if ($this->request->isPost) {
            if ($form->load($this->request->post()) && $form->validate()) {
                $user = new User();
                $password = Yii::$app->security->generateRandomString();
                $user->passwordHash = Yii::$app->security->generatePasswordHash($password);
                $user->email = $form->email;
                $user->role = $form->role;
                if ($user->validate()) {
                    $user->save();
                    $form->sendEmail();
                    $auth = Yii::$app->authManager;
                    $auth->assign($auth->getRole($user->role), $user->id);

                    return $this->redirect(['view', 'id' => $user->id]);
                }
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи: ' . $user->errors["email"][0]);
            }
        }

        return $this->render('create-user', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($this->request->isPost) {
            $authManager = Yii::$app->authManager;
            $oldRole = $authManager->getRole($model->role); // Получаем объект текущей роли пользователя
            if ($model->load($this->request->post()) && $model->validate() && $model->save()) {
                $newRole = $authManager->getRole($model->role); // Получаем объект новой роли

                $authManager->revoke($oldRole, $model->id); // Удаляем текущую роль у пользователя
                $authManager->assign($newRole, $model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);

/*            $auth = Yii::$app->authManager;
            if (Yii::$app->user->identity->role !== $model->role) {
                $auth->ro($auth->getRole($model->role), $model->id);
            }*/
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
