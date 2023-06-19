<?php

use app\modules\curriculum\models\CurriculumPattern;
use app\modules\curriculum\models\Subject;
use app\modules\group\models\Group;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-pattern-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                    'data' => ArrayHelper::map(Subject::find()
                        ->leftJoin('curriculum c', 'subject.id = c."subjectId"')
                        ->leftJoin('event e', 'c.id = e."curriculumId"')
                        ->where(['lectorId' => Yii::$app->user->id])
                        ->all(),
                        'name', 'name'),
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
                    'data' => ArrayHelper::map(Group::find()
                        ->leftJoin('curriculum', '"group".id = curriculum."groupId"')
                        ->leftJoin('event', '"curriculum".id = event."curriculumId"')
                        ->where(['lectorId' => Yii::$app->user->id])
                        ->all(),
                        'name', 'name'),
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
            'description:ntext',
            'semester',
            [
                'class' => ActionColumn::class,
            ],
        ],
    ]); ?>


</div>
