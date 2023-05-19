<?php

use app\modules\curriculum\models\CurriculumPattern;
use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Шаблоны учебных планов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-pattern-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered grid-view'],
/*        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'class' => 'my-class',
                'onclick' => 'location.href=""',
            ];
        },*/
        'pager' => [
            'options' => ['class' => 'pagination'],
            'linkOptions' => ['class' => 'page-link'],
            'activePageCssClass' => 'active',
            'disabledPageCssClass' => 'disabled',
            'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link', 'href' => '#'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subject.name',
            'description:ntext',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, CurriculumPattern $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
