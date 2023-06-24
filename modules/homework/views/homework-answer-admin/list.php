<?php

use app\models\User;
use app\modules\homework\models\HomeworkAnswer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ответы студентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'student.fullname',
            [
                'value' => function ($model) {
                    $groups = User::findOne($model->studentId)->groups;
                    return $groups[0]->name;
                },
                'label' => 'Группа',
            ],
            'mark',
            [
                'class' => ActionColumn::class,
                'template' => '{update}',
                'urlCreator' => function ($action, HomeworkAnswer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
