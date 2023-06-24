<?php

namespace app\modules\homework\controllers;

use app\models\User;
use app\modules\curriculum\models\Event;
use app\modules\homework\models\HomeworkAnswer;
use app\modules\homework\models\HomeworkAnswerSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * HomeworkAnswerAdminController implements the CRUD actions for HomeworkAnswer model.
 */
class HomeworkAnswerAdminController extends Controller
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
     * Lists all HomeworkAnswer models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new HomeworkAnswerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
        $answerIds = [];
        $answers = HomeworkAnswer::find()
            ->leftJoin('homework_event', 'homework_event.event_id = "homeworkId"')
            //->leftJoin('group', 'homework_event.event_id = "homeworkId"')
            ->leftJoin('event', 'event."lectorId" = ' . Yii::$app->user->id);
        //echo '<pre>' . print_r($answers, true) . '</pre>';die;

/*       foreach ($events as $event) {
            foreach ($event->homeworks as $homework) {
                foreach ($homework->answers as $answer) {
                    if (!empty($answer->mark))
                        continue;
                    $answerIds[] = $answer->id;
               }
            }
        }*/

       return $this->render('list', [
            //'dataProvider' => new ActiveDataProvider(['query' => HomeworkAnswer::find()->where(['id' => $answerIds])]),
            'dataProvider' => new ActiveDataProvider([
                'query' => $answers,
                'sort' => [
                    'attributes' => [
                        'mark' => [
                            'asc' => ['mark' => SORT_ASC],
                            'desc' => 'mark IS NULL DESC, mark DESC',
                        ],
                    ],
                ],
            ]),
        ]);
    }

    /**
     * Displays a single HomeworkAnswer model.
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
     * Creates a new HomeworkAnswer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate(int $homeworkId): Response|string
    {
        $model = new HomeworkAnswer();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->homeworkId = $homeworkId;
                $model->studentId = Yii::$app->user->id;
                if (!$model->validate() || !$model->save())
                {
                    throw new Exception('not load or validate data');
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing HomeworkAnswer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) &&  $model->validate() && $model->save()) {
            return $this->redirect('list');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HomeworkAnswer model.
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

    protected function findModel($id): HomeworkAnswer
    {
        if (($model = HomeworkAnswer::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
