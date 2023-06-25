<?php

namespace app\modules\material\controllers;

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class TextAdminController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'delete', 'create'],
                        'allow' => true,
                        'roles' => ['teacher'],
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

    public function actionIndex(int $id): string
    {
        $query = Text::find()->where(['material_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'id' => $id]);
    }
    public function actionCreate(int $id)
    {
        $r = \Yii::$app->security->generateRandomString();
        $model = new Text();

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

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function findModel(int $id): ?Text
    {
        if (($model = Text::findOne(['id' => $id])) !== null) {
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