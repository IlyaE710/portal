<?php

use app\models\UploadForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var UploadForm $model */

$this->title = 'Создание Ссылки';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = ['label' => 'Ссылки', 'url' => ['index', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="create-file">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>
</div>
