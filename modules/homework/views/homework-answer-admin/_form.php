<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="homework-answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'studentId')->textInput() ?>

    <?= $form->field($model, 'homeworkId')->textInput() ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
