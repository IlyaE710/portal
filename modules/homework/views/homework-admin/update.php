<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\Homework $model */

$this->title = 'Редатировать';
$this->params['breadcrumbs'][] = ['label' => 'Здания для домашних работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Домашнее задание', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="homework-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
