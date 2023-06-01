<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswer $model */

$this->title = 'Create Homework Answer';
$this->params['breadcrumbs'][] = ['label' => 'Homework Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
