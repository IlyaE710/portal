<?php

namespace app\modules\material\controllers;

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class LinkAdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(int $id): string
    {
        $query = Link::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'id' => $id]);
    }

    public function actionCreate(int $id)
    {
        $model = new Link();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->material_id = $id;
                $model->save();
                return $this->redirect(['index', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->material_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function findModel(int $id): ?Link
    {
        if (($model = Link::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $materialId = $model->material_id;
        $model->delete();

        return $this->redirect(['index', 'id' => $materialId]);
    }
}