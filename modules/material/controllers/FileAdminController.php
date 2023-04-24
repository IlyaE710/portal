<?php

namespace app\modules\material\controllers;

use app\models\UploadForm;
use app\modules\material\models\File;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class FileAdminController extends Controller
{
    public function behaviors(): array
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
        $query = File::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider, 'id' => $id]);
    }

    public function actionCreate(int $id)
    {
        $modelForm = new UploadForm();

        if ($this->request->isPost) {
            $modelForm->files = UploadedFile::getInstances($modelForm, 'files');
            $uploadDir = 'uploads';
            if ($modelForm->upload($uploadDir)) {
                foreach ($modelForm->files as $file) {
                    $model = new File();
                    $model->filename = explode('.', $file->name)[0];
                    $model->hashCode = md5($file->name);
                    $model->extension = $file->extension;
                    $model->path = $uploadDir . '/' . $model->hashCode . '.' . $model->extension;
                    $model->size = $file->size;
                    $model->material_id = $id;
                    $model->save();
                }
            }
            return $this->redirect(['index', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $modelForm,
            'id' => $id,
        ]);
    }

    public function actionDelete(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);
        $materialId = $model->material_id;
        unlink((string) Yii::getAlias('@app/web/' . $model->path));
        $model->delete();

        return $this->redirect(['index', 'id' => $materialId]);
    }

    private function findModel(int $id): ?File
    {
        if (($model = File::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Страницы не существует');
    }

}