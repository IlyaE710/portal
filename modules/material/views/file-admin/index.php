<?php

use app\modules\material\models\File;
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

$this->title = 'Файлы';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="links">

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Меню</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li>
                            <?= Html::a('Оснавная информация', Url::toRoute(['material-admin/update', 'id' => $id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?= Html::a('Ссылки', Url::toRoute(['link-admin/index', 'id' => $id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?= Html::a('Файлы', Url::toRoute(['file-admin/index', 'id' => $id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                        <li>
                            <?= Html::a('Тексты', Url::toRoute(['text-admin/index', 'id' => $id]), ['class' => ['nav-link px-0 align-middle']]) ?>
                        </li>
                    </ul>
                </div>
            </div>
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

</div>