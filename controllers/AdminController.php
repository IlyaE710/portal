<?php

namespace app\controllers;

class AdminController extends \yii\web\Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }
}