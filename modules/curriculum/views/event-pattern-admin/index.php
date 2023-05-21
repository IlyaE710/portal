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

$this->title = 'Мероприятия';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны учебных планов', 'url' => ['curriculum-pattern-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['curriculum-pattern-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-pattern-admin/update', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-pattern-admin/index', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="row">
    <p>
        <?= Html::a('Создать', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'type.name',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, EventPattern $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
</div>
