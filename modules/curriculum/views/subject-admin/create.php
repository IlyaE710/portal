<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Subject $model */

$this->title = 'Создать предмет';
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
