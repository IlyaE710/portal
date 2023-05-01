<?php

use app\modules\material\models\Material;
use app\modules\material\widgets\sidebar\SidebarWidget;
use yii\bootstrap5\Nav;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Материалы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-3">
                <div class="panel panel-default">
                    <div class="panel-body sidebar">
                        <?= \yii\widgets\Menu::widget([
                            'options' => [
                                'class' => 'nav-pills nav-stacked',
                            ],
                            'items' => [
                                ['label' => 'Основная информация', 'url' => ['/site/index']],
                                ['label' => 'Ссылки', 'url' => ['/site/about']],
                                ['label' => 'Файлы', 'url' => ['/site/contact']],
                                ['label' => 'Тексты', 'url' => ['/site/contact']],
                            ]
                        ]); ?>
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'title',
                    [
                        'attribute' => 'description',
                        'value' => function(Material $model): string {
                            return StringHelper::truncateWords($model->description, 20, '...');
                        }
                    ],
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Material $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>