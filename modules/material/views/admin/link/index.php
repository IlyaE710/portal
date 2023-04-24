<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Materials');
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'url:url',
            [
                'attribute' => 'description',
                'value' => function(Link $model): string {
                    return StringHelper::truncateWords($model->description, 20, '...');
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Link $model, $key, $index, $column) {
                    return Url::toRoute([$action . '-link', 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>