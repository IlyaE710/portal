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
$this->params['breadcrumbs'][] = ['label' => 'План', 'url' => ['curriculum/view', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
