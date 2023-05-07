<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
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

<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' =>$id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' =>$id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
            ]
        ]); ?>
    </div>
    <div class="col-md-9">
        <p>
            <?= Html::a('Создать', Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']) ?>
        </p>
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