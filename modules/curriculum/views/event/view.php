<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\widgets\sidebar\SidebarWidget;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Event $model */

$this->title = $model->type->name . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['curriculum/view', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = $this->title;

$currentUrl = Url::current();
$itemsEvent = [];
$items = [];
foreach ($model->curriculum->events as $event) {
    $url = Url::toRoute(['event/view', 'id' => $event->id]);
    if ($currentUrl === $url) {
        $url = Url::toRoute(['event/view', 'id' => $event->id, '#' => 'header']);
    }
    $itemsEvent[] = [
        'label' => $event->type->name . ' ' . $event->title,
        'url' => $url,
    ];
}
$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
/*        [
            'label' => 'Пользователи',
            'url' => Url::to(['curriculum/view', 'id' => $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],*/
        [
            'label' => 'Список',
            'url' => '',
            'options' => ['class' => 'nav-link px-0 align-middle'],
            'template' => '<div class="sidebar-item" onclick="togglePopup(\'popup-2\')" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-list-check"></i></div>'
        ],
        [
            'label' => 'Ссылки',
            'url' => Url::to(['event/view', 'id' => $model->id, '#' => 'link-grid-view']),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-link"></i></div></a>'
        ],
        [
            'label' => 'Файлы',
            'url' => Url::to(['event/view', 'id' => $model->id, '#' => 'file-grid-view']),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-file-earmark-code"></i></div></a>'
        ],
    ],
    'collapses' => $itemsEvent,
]);
Pjax::begin();
?>

<div class="event-index">
    <?php foreach($model->materials as $material): ?>
        <?php foreach($material->texts as $text): ?>
            <?= $text->content ?>
        <?php endforeach; ?>

        <?php Pjax::begin() ?>
    <?php if($material->getLinks()->count() !== 0): ?>
        <?= GridView::widget([
            'id' => 'link-grid-view',
            'dataProvider' => new ActiveDataProvider([
                'query' => $material->getLinks(),
            ]),
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped'],
            'columns' => [
                ['class' => SerialColumn::class],
                'url:url',
            ],
        ]); ?>
        <?php endif; ?>
        <?php Pjax::end() ?>

        <?php Pjax::begin() ?>

        <?php if($material->getFiles()->count() !== 0): ?>
        <?= GridView::widget([
            'id' => 'file-grid-view',
            'dataProvider' => new ActiveDataProvider([
                'query' => $material->getFiles(),
            ]),
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped'],
            'columns' => [
                ['class' => SerialColumn::class],
                'filename:raw',
                [
                    'attribute' => 'url',
                    'label' => 'Ссылка',
                    'format' => 'raw',
                    'value' => function (File $model) {
                        return Html::a(
                            'Посмотреть',
                            Yii::getAlias('@web/'. $model->path), ['target' => '_blank', 'data-pjax' => '0']
                        );
                    }
                ],
            ],
        ]); ?>
        <?php endif; ?>
        <?php Pjax::end() ?>
    <?php endforeach; ?>

    <?php if($model->getHomeworks()->count() !== 0): ?>
        <?= GridView::widget([
            'id' => 'link-grid-view',
            'dataProvider' => new ActiveDataProvider([
                'query' => $model->getHomeworks(),
            ]),
            'options' => ['class' => 'table-responsive'],
            'tableOptions' => ['class' => 'table table-striped'],
            'columns' => [
                ['class' => SerialColumn::class],
                'title:text',
                [
                    'format' => 'raw',
                    'value' => function ($homework) use ($model) {
                        return Html::a(
                            'Перейти',
                            Url::toRoute(
                                    [
                                        '/homework/homework-answer/index',
                                        'curriculumId' => $model->curriculumId,
                                        'eventId' => $model->id,
                                        'homeworkId' => $homework->id,
                                    ]), ['target' => '_blank', 'data-pjax' => '0']
                        );
                    }
                ],
            ],
        ]); ?>
    <?php endif; ?>
</div>
<?php Pjax::end();
