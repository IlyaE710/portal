<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

<div class="reset-password-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Пожалуйста, введите вашу электронную почту. Новый пароль будет отправлена на указанный адрес.</p>

    <?php $form = ActiveForm::begin([
        'id' => 'reset-password-form',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>

    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary my-2']) ?>
        </div>
    </div>

    <?php ActiveForm::end() ?>
</div>






