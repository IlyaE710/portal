<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswer $model */

$this->title = 'Ответ на Д/З: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список Д/З', 'url' => ['list']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="homework-answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
