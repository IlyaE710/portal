<?php

use app\modules\material\models\File;
use app\modules\material\models\Link;
use app\modules\material\models\Material;
use app\modules\material\models\Text;
use app\widgets\sidebar\SidebarWidget;
use yii\bootstrap5\Modal;
use yii\data\ActiveDataProvider;
use yii\debug\models\timeline\DataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var Material $model */

$this->title = 'Материал - ' . '"'.$model->title.'"';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <?= SidebarWidget::widget([
                'items' => [
                    ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                    ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                    ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                    ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ]
            ]); ?>
        </div>
        <div class="col-md-9">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
