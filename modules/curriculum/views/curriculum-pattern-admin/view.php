<?php

use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны учебных планов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
$items = [];
foreach ($model->eventPatterns as $eventPattern) {
    $items[] = [
            'label' => $eventPattern->type->name . ' ' . $eventPattern->title,
            'url' => Url::toRoute(['event-pattern-admin/view', 'id' => $eventPattern->id]),
            'options' => ['class' => 'nav-link px-0 align-middle'],
    ];
}
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => $items
        ]); ?>
    </div>
    <div class="col-md-9">
        <div class="link-update">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'subjectId',
                    'description:ntext',
                ],
            ]) ?>
        </div>
    </div>
</div>
