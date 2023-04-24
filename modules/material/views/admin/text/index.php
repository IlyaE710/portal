<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
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

    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'description',
                'value' => function(Text $model): string {
                    return StringHelper::truncateWords($model->content, 20, '...');
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Text $model, $key, $index, $column) {
                    return Url::toRoute([$action . '-text', 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>


</div>