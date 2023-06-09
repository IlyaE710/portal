<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Event;
use app\modules\curriculum\models\EventPattern;
use app\modules\homework\models\Homework;
use app\modules\material\models\Material;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventPatternAdminController implements the CRUD actions for EventPattern model.
 */
class EventPatternAdminController extends Controller
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

    /**
     * Lists all EventPattern models.
     *
     * @return string
     */
    public function actionIndex(int $id)
    {
        $isAdmin = Yii::$app->user->identity->role === 'admin';
        $template = '{view} {update} {delete}';
        if (!$isAdmin) {
            $template = '{view} {update}';
        }

        $dataProvider = new ActiveDataProvider([
            'query' => EventPattern::find()->where(['curriculumId' => $id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id' => $id,
            'isAdmin' => $isAdmin,
            'template' => $template,
        ]);
    }

    /**
     * Displays a single EventPattern model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $isAdmin = Yii::$app->user->identity->role === 'admin';
        return $this->render('view', [
            'model' => $this->findModel($id),
            'isAdmin' => $isAdmin,
        ]);
    }

    /**
     * Creates a new EventPattern model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(int $id)
    {
        $model = new EventPattern();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->curriculumId = $id;
                    if (!$model->validate() || !$model->save()) {
                        throw new \yii\db\Exception('Не сохранились данные');
                    }

                    if (!empty($this->request->post('EventPattern')['materials'])) {
                        $materialIds = $this->request->post('EventPattern')['materials'];
                        $materials = Material::findAll($materialIds);
                        foreach ($materials as $material) {
                            $model->link('materials', $material);
                        }
                    }

                    if (!empty($this->request->post('EventPattern')['homeworks'])) {
                        $homeworkIds = $this->request->post('EventPattern')['homeworks'];
                        $homeworks = Homework::findAll($homeworkIds);
                        foreach ($homeworks as $homework) {
                            $model->link('homeworks', $homework);
                        }
                    }
                    $transaction->commit();
                } catch (Exception $e) {
                    Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи:');
                    return $this->redirect(['create', 'id' => $id]);
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
    public function actionUpdate($id): \yii\web\Response|string
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $materialIds = $this->request->post('EventPattern')['materials'];
            $homeworkIds = $this->request->post('EventPattern')['homeworks'];
            if (!$model->validate() || !$model->save()) {
                throw new \yii\db\Exception('Не сохранились данные');
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!empty($this->request->post('EventPattern')['materials'])) {
                    $materials = Material::findAll($materialIds);
                    $model->unlinkAll('materials', true);

                    foreach ($materials as $material) {
                        $model->link('materials', $material);
                    }
                }

                if (!empty($this->request->post('EventPattern')['homeworks'])) {
                    $homeworks = Homework::findAll($homeworkIds);
                    $model->unlinkAll('homeworks', true);

                    foreach ($homeworks as $homework) {
                        $model->link('homeworks', $homework);
                    }
                }
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи:');
                return $this->redirect(['update', 'id' => $model->id]);
            }
            return $this->redirect(['index', 'id' => $model->curriculumId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EventPattern model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete(int $id): \yii\web\Response
    {
        $model = $this->findModel($id);
        $curriculumId = $model->curriculumId;
        $model->delete();

        return $this->redirect(['index', 'id' => $curriculumId]);
    }

    /**
     * Finds the EventPattern model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return EventPattern the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EventPattern::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
