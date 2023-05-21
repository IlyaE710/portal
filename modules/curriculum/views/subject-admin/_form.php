<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Subject $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
