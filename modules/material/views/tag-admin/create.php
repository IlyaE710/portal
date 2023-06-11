<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\material\models\Tag $model */

$this->title = 'Создать тэг';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/']];
$this->params['breadcrumbs'][] = ['label' => 'Тэги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
