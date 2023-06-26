<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumPattern;
use app\modules\curriculum\models\Event;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class CurriculumController extends \yii\web\Controller
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
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionView(int $id): string
    {
        $events = Event::find()->where(['curriculumId' => $id])->orderBy(['startDate' => SORT_ASC])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'events' => $events,
        ]);
    }

    protected function findModel($id): ?Curriculum
    {
        if (($model = Curriculum::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}