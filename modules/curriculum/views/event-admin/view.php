<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Event $model */

$this->title = $model->type->name . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны учебных планов', 'url' => ['curriculum-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['curriculum-admin/update', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятие', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Вид';
?>
<div class="event-pattern-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?php foreach($model->materials as $material): ?>
        <?php foreach($material->texts as $text): ?>
            <?= $text->content ?>
        <?php endforeach; ?>

        <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $material->getLinks(),
            ]),
            'columns' => [
                ['class' => SerialColumn::class],
                'url:url',
                [
                    'attribute' => 'description',
                    'value' => function(Link $model): string {
                        return StringHelper::truncateWords($model->description, 20, '...');
                    }
                ],
            ],
        ]); ?>
        <?php Pjax::end() ?>


        <?php Pjax::begin() ?>
        <?= GridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $material->getFiles(),
            ]),
            'columns' => [
                ['class' => SerialColumn::class],
                'filename:raw',
                [
                    'attribute' => 'url',
                    'format' => 'raw',
                    'value' => function (File $model) {
                        return Html::a(
                            'Посмотреть',
                            Yii::getAlias('@web/'. $model->path),
                            ['target' => '_blank', 'data-pjax' => '0']
                        );
                    }
                ],
                [
                    'class' => ActionColumn::class,
                    'template' => '{delete}',
                ],
            ],
        ]); ?>
        <?php Pjax::end() ?>
    <?php endforeach; ?>
</div>
