<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\CourseForm;
use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumAdminSearch;
use app\modules\curriculum\models\CurriculumPattern;
use app\modules\curriculum\models\Event;
use app\modules\curriculum\models\SelectCurriculumForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CurriculumController implements the CRUD actions for Curriculum model.
 */
class CurriculumAdminController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'delete', 'select-pattern', 'create', 'upload-image'],
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
        $searchModel = new CurriculumAdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
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

    public function actionCreate(int $modelFormId): \yii\web\Response|string
    {
        $model = new Curriculum();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->subjectId = $this->request->post('Curriculum')['subject'];
                $model->groupId = $this->request->post('Curriculum')['group'];
                $model->authorId = Yii::$app->user->id;

                $image = UploadedFile::getInstance($model, 'image');
                if ($image !== null) {
                    // Генерируем уникальное имя файла
                    $filename = uniqid() . '.' . $image->extension;
                    // Сохраняем изображение в папку
                    $image->saveAs(Yii::getAlias('@app/web/uploads/course/') . $filename);
                    // Сохраняем имя файла в модель
                    $model->image = $filename;
                }

                $model->save();

                $modelForm = CurriculumPattern::findOne($modelFormId);
                foreach ($modelForm->eventPatterns as $eventPattern) {
                    $event = new Event();
                    $event->title = $eventPattern->title;
                    $event->typeId = $eventPattern->typeId;
                    $event->lectorId = $eventPattern->lectorId;
                    $event->startDate = $eventPattern->startDate;
                    $event->curriculumId = $eventPattern->curriculumId;
                    $model->link('events', $event);

                    foreach ($eventPattern->materials as $material) {
                        $event->link('materials', $material);
                    }

                    foreach ($eventPattern->homeworks as $homework) {
                        $event->link('homeworks', $homework);
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

    public function actionSelectPattern(): \yii\web\Response|string
    {
        $model = new SelectCurriculumForm();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            return $this->redirect(['create', 'modelFormId' => $model->idTemplate]);
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->groupId = $this->request->post('Curriculum')['group'];
            $model->subjectId = $this->request->post('Curriculum')['subject'];
            $imageOld = $model->image;

            $image = UploadedFile::getInstance($model, 'image');
            if ($image !== null) {
                // Генерируем уникальное имя файла
                $filename = uniqid() . '.' . $image->extension;
                // Сохраняем изображение в папку
                $image->saveAs(Yii::getAlias('@app/web/uploads/course/') . $filename);
                // Сохраняем имя файла в модель
                $model->image = $filename;
                if ($imageOld !== 'thumb.png') {
                    unlink(Yii::getAlias('@app/web/uploads/course/') . $imageOld);
                }
            }

            $model->save();

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
        $model = $this->findModel($id);
        $image = $model->image;
        if ($image !== 'thumb.png') {
            unlink(Yii::getAlias('@app/web/uploads/course/'. $image));
        }

        $model->delete();

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
