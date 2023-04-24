<?php

namespace app\modules\material\controllers;

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Tag;
use app\modules\material\models\Text;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AdminController extends Controller
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

    public function actionIndex(): string
    {
        $query = Material::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreateMaterial()
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

                return $this->redirect(['update-material', 'id' => $model->id]);
            }
        }

        return $this->render('create-material', [
            'model' => $model,
        ]);
    }

    public function actionUpdateMaterial(int $id)
    {
        $model = $this->findMaterialModel($id);

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

        return $this->render('update-material', [
            'model' => $model,
        ]);
    }

    public function actionIndexLink()
    {
        $query = Link::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('link/index', ['dataProvider' => $dataProvider]);
    }
    public function actionAddLink(int $id)
    {
        $model = new Link();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->material_id = $id;
                $model->save();
                return $this->redirect(['update-material', 'id' => $id]);
            }
        }

        return $this->renderAjax('link/add', [
            'model' => $model,
            'materialId' => $id,
        ]);
    }

    public function actionDeleteLink(int $id)
    {
        $model = $this->findLinkModel($id);
        $materialId = $model->material_id;
        $model->delete();

        return $this->redirect(['update-material', 'id' => $materialId]);
    }

    public function actionAddText(int $id)
    {
        $model = new Text();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->material_id = $id;
                $model->save();
                return $this->redirect(['update-material', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'material_id' => $id,
        ]);
    }

    public function actionViewText(int $id): string
    {
        return $this->render('text/view', [
            'model' => $this->findTextModel($id),
        ]);
    }

    public function actionUpdateText(int $id)
    {
        if ($this->request->isAjax) {
            echo '<pre>' . print_r('asdasd', true) . '</pre>';die;
        }
        $model = $this->findTextModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('text/update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteText(int $id)
    {
        $model = $this->findTextModel($id);
        $materialId = $model->material_id;
        $model->delete();

        return $this->redirect(['update-material', 'id' => $materialId]);
    }

    private function findMaterialModel(int $id): ?Material
    {
        if (($model = Material::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }

    private function findLinkModel(int $id): ?Link
    {
        if (($model = Link::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }

    private function findTextModel(int $id): ?Text
    {
        if (($model = Text::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }
}