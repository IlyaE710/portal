<?php

namespace app\modules\homework\controllers;

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\Event;
use app\modules\homework\models\FileUploadForm;
use app\modules\homework\models\Homework;
use app\modules\homework\models\HomeworkAnswer;
use app\modules\homework\models\HomeworkFile;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\UploadedFile;

class HomeworkAnswerController extends \yii\web\Controller
{
    public function behaviors(): array
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(int $curriculumId, int $eventId, int $homeworkId)
    {
        $model = new HomeworkAnswer();
        $isBlockForm = false;
        $homework = Homework::find()
            ->leftJoin('homework_event', 'homework_event.homework_id = id')
            ->leftJoin('event', 'event."id" = homework_event.event_id')
/*            ->where(
                [
                    'curriculumId' => $curriculumId,
                    'id' => $eventId,
                ])*/
            ->one();

        if (!empty($homework)) {
            foreach ($homework->answers as $answer) {
                if ($answer->mark === '5' || $answer->mark === 'Зачет' || $answer->mark === '4'  || $answer->mark === '3') {
                    $isBlockForm = true;
                    break;
                }
            }
        }

        if (Yii::$app->user->identity->role === 'teacher' || Yii::$app->user->identity->role === 'admin') {
            $isBlockForm = true;
        }

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {
                $model->files = UploadedFile::getInstances($model, 'files');
                $model->homeworkId = $homeworkId;
                $model->studentId = Yii::$app->user->id;
                if (!$model->validate() || !$model->save())
                {
                    throw new Exception('not load or validate data');
                }

                if ($model->upload()) {
                    foreach ($model->files as $file) {
                        $modelFile = new HomeworkFile();
                        $modelFile->pathname = $file->name;
                        $modelFile->homeworkAnswerId = $model->id;
                        $modelFile->save();
                    }
                }

                return $this->redirect(['index', 'form', 'model' => $model, 'homework' => $homework, 'curriculumId' => $curriculumId, 'eventId' => $eventId, 'homeworkId' => $homeworkId, 'isBlockForm' => $isBlockForm]);
            }
        }

        return $this->render('index', ['model' => $model, 'form', 'homework' => $homework, 'curriculumId' => $curriculumId, 'eventId' => $eventId, 'homeworkId' => $homeworkId, 'isBlockForm' => $isBlockForm]);
    }

}