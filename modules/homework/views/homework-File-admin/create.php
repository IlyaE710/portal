<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkFile $model */

$this->title = 'Create Homework File';
$this->params['breadcrumbs'][] = ['label' => 'Homework Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="homework-file-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
