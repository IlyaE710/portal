<?php

namespace app\modules\profile\controllers;

use app\models\ChangeEmail;
use app\models\ChangePassword;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends Controller
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
                'rules' => [
                    [
                        'actions' => ['index', 'changePassword', 'changeEmail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'changePassword' => ['post'],
                    'changeEmail' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex(): string
    {
        $model = Yii::$app->user->identity;
        return $this->render('index', ['model' => $model]);
    }

    public function actionChangeEmail(): \yii\web\Response|string
    {
        $model = new ChangeEmail();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->change()) {
            return $this->redirect('index');
        }

        return $this->render('change-email', ['model' => $model]);
    }

    public function actionChangePassword(): \yii\web\Response|string
    {
        $model = new ChangePassword();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->change()) {
            return $this->redirect('index');
        }

        return $this->render('change-password', ['model' => $model]);
    }
}
