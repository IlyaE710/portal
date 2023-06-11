<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\material\models\Tag $model */

$this->title = 'Редактирование тэга: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/']];
$this->params['breadcrumbs'][] = ['label' => 'Тэги', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
