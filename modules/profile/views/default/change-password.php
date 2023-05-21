<?php

use app\models\ChangePassword;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ChangePassword */
?>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Изменение Пароля</h5>
        <?php $form = ActiveForm::begin(['id' => 'password-change-form']); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput() ?>

        <?= $form->field($model, 'newPassword')->passwordInput() ?>

        <?= $form->field($model, 'confirmNewPassword')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Изменить пароль', ['class' => 'btn btn-primary my-2', 'name' => 'password-change-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>