<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkFile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="homework-file-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'homeworkAnswerId')->textInput() ?>

    <?= $form->field($model, 'pathname')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
