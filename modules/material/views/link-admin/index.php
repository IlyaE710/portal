<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ссылки';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col py-3">
    <div class="link-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="button-group" role="group"">
        <?= Html::a('Создать', Url::to(['create', 'id' => $id]), ['class' => ['btn btn-success']]) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            'url:url',
            [
                'attribute' => 'description',
                'value' => function(Link $model): string {
                    return StringHelper::truncateWords($model->description, 20, '...');
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{update} {delete}',
//                            'urlCreator' => function ($action, Link $model, $key, $index, $column) {
//                                return Url::toRoute([$action, 'id' => $model->id]);
//                            }
            ],
        ],
    ]); ?>


</div>