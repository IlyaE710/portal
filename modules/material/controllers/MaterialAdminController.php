<?php

namespace app\modules\material\controllers;

use app\modules\material\models\Material;
use app\modules\material\models\Tag;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class MaterialAdminController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'delete'],
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

    public function actionIndex(): string
    {
        $query = Material::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new Material();

        if ($this->request->isPost) {
            $post = $this->request->post();
            if ($model->load($post) && $model->validate() && $model->save()) {
                $tagIds = $post['Material']['tags'];
                $tags = Tag::findAll($tagIds);

                foreach ($tags as $tag) {
                    $model->link('tags', $tag);
                }

                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $post = $this->request->post();
            $tagIds = $post['Material']['tags'];
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $tags = Tag::findAll($tagIds);
                $model->unlinkAll('tags', true);

                foreach ($tags as $tag) {
                    $model->link('tags', $tag);
                }

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи: ' . $e->getMessage());
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect('index');
    }

    private function findModel(int $id): ?Material
    {
        if (($model = Material::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }
}