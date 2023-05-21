<?php

use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
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
/** @var Text $model */

$this->title = 'Тексты';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['material-admin/update', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Ссылки',
            'url' =>  Url::to(['link-admin/index', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-link"></i></div></a>'
        ],
        [
            'label' => 'Файлы',
            'url' =>  Url::to(['file-admin/index', 'id' => $id ??$model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-file-earmark"></i></div></a>'
        ],
        [
            'label' => 'Тексты',
            'url' =>  Url::to(['text-admin/index', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center text-dark'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-card-text"></i></div></a>'
        ],
    ],
]);
?>

<div class="row">
    <p>
        <?= Html::a('Создать', Url::to(['create', 'id' => $id]), ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => SerialColumn::class],
            [
                'class' => ActionColumn::class,
            ],
        ],
    ]); ?>
</div>