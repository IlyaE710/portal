<?php

use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */
/** @var bool $isAdmin */

$this->title = $model->subject->name;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
$itemsEvent = [];
$items = [];
foreach ($model->eventPatterns as $event) {
    $itemsEvent[] = [
        'label' => $event->type->name . ' ' . $event->title,
        'url' => Url::toRoute(['event-pattern-admin/view', 'id' => $event->id]),
    ];
}
$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Список',
            'url' => Url::to(['material-admin/update', 'id' => 1]),
            'options' => ['class' => 'nav-link px-0 align-middle'],
            'template' => '<div class="sidebar-item" onclick="togglePopup(\'popup-2\')" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-list-check"></i></div>'
        ],
    ],
    'collapses' => $itemsEvent,
]);
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="link-update">
        <p>
            <?php if ($isAdmin): ?>
            <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?php endif; ?>
        </p>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'subject.name',
                'description:ntext',
            ],
        ]) ?>
    </div>
</div>
