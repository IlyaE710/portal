<?php

namespace app\modules\profile\controllers;

use app\models\ChangeEmail;
use app\models\ChangePassword;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends Controller
{
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
