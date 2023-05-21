<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Curriculum $model */

$this->title = 'Редактирование курса';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирования';
?>
<div class="curriculum-update">
    <?= Html::img(Yii::getAlias('@web/uploads/course/'. $model->image), ['class' => 'img-thumbnail']) ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
