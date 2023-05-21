<?php

?>

<div class="user-form">

    <?php use yii\bootstrap5\Html;
    use yii\widgets\ActiveForm;

    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        'student' => 'student',
        'teacher' => 'teacher',
        'admin' => 'admin',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
