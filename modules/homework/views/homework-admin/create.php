<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\Homework $model */

$this->title = 'Создать домашнее задание';
$this->params['breadcrumbs'][] = ['label' => 'Здания для домашних работ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
