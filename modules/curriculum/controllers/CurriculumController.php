<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumPattern;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CurriculumController extends \yii\web\Controller
{
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id): ?Curriculum
    {
        if (($model = Curriculum::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}