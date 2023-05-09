<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Event;
use app\modules\curriculum\models\EventPattern;
use app\modules\material\models\Material;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventAdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex(int $id)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()->where(['curriculumId' => $id]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    /**
     * Displays a single Event model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(int $id)
    {
        $model = new Event();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->typeId = $this->request->post('Event')['type'];
                $model->curriculumId = $id;
                $model->save();
                $materialIds = $this->request->post('Event')['materials'];
                $materials = Material::findAll($materialIds);
                foreach ($materials as $material) {
                    $model->link('materials', $material);
                }
                return $this->redirect(['index', 'id' => $id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    /**
     * Updates an existing EventPattern model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $materialIds = $this->request->post('Event')['materials'];
            $model->typeId = $this->request->post('Event')['type'];
            $model->save();

            $transaction = Yii::$app->db->beginTransaction();
            try {
                $materials = Material::findAll($materialIds);
                $model->unlinkAll('materials', true);

                foreach ($materials as $material) {
                    $model->link('materials', $material);
                }

                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи: ' . $e->getMessage());
            }
            return $this->redirect(['index', 'id' => $model->curriculumId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
