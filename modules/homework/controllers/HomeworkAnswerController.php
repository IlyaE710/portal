<?php

namespace app\modules\homework\controllers;

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\Event;
use app\modules\homework\models\HomeworkAnswer;
use Yii;
use yii\db\Exception;

class HomeworkAnswerController extends \yii\web\Controller
{
    public function actionIndex(int $curriculumId, int $eventId, int $homeworkId)
    {
        $model = new HomeworkAnswer();
        $isBlockForm = false;
        $event = Event::find()
            ->where(
                [
                    'curriculumId' => $curriculumId,
                    'id' => $eventId,
                ])
            ->one();
        $homework = null;

        foreach ($event->homeworks as $homeworkFinder) {
            if ($homeworkFinder->id === $homeworkId)
                foreach ($homeworkFinder->answers as $answer) {
                    if ($answer->studentId === Yii::$app->user->id) {

                    }
                    $homework = $homeworkFinder;
                }
        }
        if (!empty($homework)) {
            foreach ($homework->answers as $answer) {
                if ($answer->mark === '5' || $answer->mark === 'Зачет') {
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
                $model->homeworkId = $homeworkId;
                $model->studentId = Yii::$app->user->id;
                if (!$model->validate() || !$model->save())
                {
                    throw new Exception('not load or validate data');
                }
                return $this->redirect(['index', 'model' => $model, 'homework' => $homework, 'curriculumId' => $curriculumId, 'eventId' => $eventId, 'homeworkId' => $homeworkId, 'isBlockForm' => $isBlockForm]);
            }
        }

        return $this->render('index', ['model' => $model, 'homework' => $homework, 'curriculumId' => $curriculumId, 'eventId' => $eventId, 'homeworkId' => $homeworkId, 'isBlockForm' => $isBlockForm]);
    }

}