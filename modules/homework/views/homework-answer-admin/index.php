<?php

use app\modules\homework\models\HomeworkAnswer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Homework Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'studentId',
            'homeworkId',
            'content:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, HomeworkAnswer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
