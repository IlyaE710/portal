<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ссылки';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row flex-nowrap">
        <!-- Сайдбар -->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light">
            <div class="sidebar">
                <?= Menu::widget([
                    'options' => [
                        'class' => ['nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start'],
                    ],
                    'items' => [
                        ['label' => 'Основная информация', 'url' => Url::to(['update', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                    ]
                ]); ?>
                <br>
            </div>
        </div>

        <!-- Зона контента -->
        <div class="col-lg-9">
            <div class="content">
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
        </div>
    </div>
</div>