<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use yii\bootstrap5\Modal;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var Link $model */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = ['label' => 'Тексты', 'url' => ['index', 'id' => $model->material_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-1">
        <div style="width: 250px; height: 100%; background-color: #f5f5f5; position: fixed; top: 0; left: 0; overflow-x: hidden; padding-top: 20px;" class="sidebar">
            <?php
            echo Menu::widget([
                'options' => [
                    'style' => 'list-style-type: none; margin: 0; padding: 0;',
                    'class' => 'sidebar-menu'
                ],
                'items' => [
                    ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $model->material_id]), 'options' => ['style' => 'margin-bottom: 15px; margin-left: 10px;', 'class' => 'sidebar-item']],
                    ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $model->material_id]), 'options' => ['style' => 'margin-bottom: 15px; margin-left: 10px;', 'class' => 'sidebar-item']],
                    ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $model->material_id]), 'options' => ['style' => 'margin-bottom: 15px; margin-left: 10px;', 'class' => 'sidebar-item']],
                    ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $model->material_id]), 'options' => ['style' => 'margin-bottom: 15px; margin-left: 10px;', 'class' => 'sidebar-item']],
                ],
                'activeCssClass' => 'active',
                'encodeLabels' => false,
                'linkTemplate' => '<a style="color: #000; display: block; text-decoration: none; padding: 10px 15px; transition: all 0.3s ease;" href="{url}">{label}</a>',
            ]);
            ?>
        </div>
    </div>

    <div class="col-md-9">
        <div class="material-update">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>