<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Subject $model */

$this->title = 'Редактировать предмет: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/']];
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="subject-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
