<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\CurriculumPattern;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class CurriculumPatternTeacherController extends \yii\web\Controller
{
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CurriculumPattern::find()
                ->leftJoin('event_pattern', 'curriculum_pattern.id = event_pattern."curriculumId"')
                ->andWhere(['lectorId' => Yii::$app->user->identity->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = CurriculumPattern::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}