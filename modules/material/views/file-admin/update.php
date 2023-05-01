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
$this->params['breadcrumbs'][] = ['label' => 'Ссылки', 'url' => ['index', 'id' => $model->material_id]];
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
                        ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                        ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                    ]
                ]); ?>
                <br>
            </div>
        </div>

        <!-- Зона контента -->
        <div class="col-lg-9">
            <div class="content">
                <h1><?= Html::encode($this->title) ?></h1>

                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>
            </div>
        </div>
    </div>
</div>
