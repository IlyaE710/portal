<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Event;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EventController extends Controller
{
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id): ?Event
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}