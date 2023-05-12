<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumPattern;
use app\modules\curriculum\models\Event;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CurriculumController implements the CRUD actions for Curriculum model.
 */
class CurriculumAdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'delete', 'select-pattern'],
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

    /**
     * Lists all Curriculum models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Curriculum::find(),
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
        ]);
    }

    /**
     * Displays a single Curriculum model.
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

    public function actionCreate(int $modelFormId)
    {
        $model = new Curriculum();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->subjectId = $this->request->post('Curriculum')['subject'];
                $model->save();

                $modelForm = CurriculumPattern::findOne($modelFormId);

                foreach ($modelForm->eventPatterns as $eventPattern) {
                    $event = new Event();
                    $event->title = $eventPattern->title;
                    $event->typeId = $eventPattern->typeId;
                    $event->curriculumId = $eventPattern->curriculumId;
                    $model->link('events', $event);

                    foreach ($eventPattern->materials as $material) {
                        $event->link('materials', $material);
                    }
                }

                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        if (!empty($modelFormId)) {
            $modelForm = CurriculumPattern::findOne($modelFormId);
            $model->subjectId = $modelForm->subjectId;
            $model->description = $modelForm->description;
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSelectPattern()
    {
        $model = new CurriculumPattern();

        if ($this->request->isPost) {
            $id = $this->request->post('id');
            return $this->redirect(['create', 'modelFormId' => $id]);
        }

        return $this->render('select-pattern', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Curriculum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Curriculum model.
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
     * Finds the Curriculum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Curriculum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Curriculum::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
