<?php

use app\modules\curriculum\models\Event;
use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Меропрития';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['/curriculum/curriculum-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['/curriculum/curriculum-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' => Url::to(['curriculum-admin/update', 'id' => $id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-admin/index', 'id' => $id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="event-index">
    <p>
        <?= Html::a('Создать', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'duration',
            'type.name',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Event $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
