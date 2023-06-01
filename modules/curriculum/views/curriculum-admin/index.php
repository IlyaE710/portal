<?php

use app\models\User;
use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\Subject;
use app\modules\group\models\Group;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курс';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['select-pattern'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'subjectName',
                'value' => 'subject.name',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'subjectName',
                    'data' => ArrayHelper::map(Subject::find()->all(), 'name', 'name'),
                    'options' => ['placeholder' => 'Выберите предмет ...'],
                    'pluginOptions' => ['allowClear' => true]
                ]),
            ],
            [
                'attribute' => 'groupName',
                'value' => 'group.name',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'groupName',
                    'data' => ArrayHelper::map(Group::find()->all(), 'name', 'name'),
                    'options' => ['placeholder' => 'Выберите группу ...'],
                    'pluginOptions' => ['allowClear' => true]
                ]),
            ],
/*            [
                'attribute' => 'authorName',
                'value' => 'author.fullname',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'authorName',
                    'data' => ArrayHelper::map(User::find()->all(), 'fullname', 'fullname'),
                    'options' => ['placeholder' => 'Выберите автор ...'],
                    'pluginOptions' => ['allowClear' => true]
                ]),
            ],*/
            'author.fullname',
            'description:ntext',
            'semester',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Curriculum $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
