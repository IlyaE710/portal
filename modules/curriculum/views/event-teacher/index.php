<?php

use app\modules\curriculum\models\EventPattern;
use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var EventPattern $model */
/** @var int $id */

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['curriculum-teacher/index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['curriculum-teacher/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-teacher/update', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-teacher/index', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="row">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'type.name',
            [
                'class' => ActionColumn::class,
                'template' => '{update}'
            ],
        ],
    ]); ?>
</div>