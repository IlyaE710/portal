<?php

use app\modules\curriculum\models\CurriculumPattern;
use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Шаблоны курсов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-pattern-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'options' => ['class' => 'pagination'],
            'linkOptions' => ['class' => 'page-link'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'subject.name',
            'description:ntext',
            [
                'class' => ActionColumn::class,
                'template' => '{update}'
            ],
        ],
    ]); ?>


</div>
