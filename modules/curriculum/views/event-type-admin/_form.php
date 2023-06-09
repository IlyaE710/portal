<?php

use app\modules\curriculum\models\EventType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var EventType $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
