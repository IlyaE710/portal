<?php

use app\models\ChangeEmail;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ChangeEmail */
$this->title = "Поменять Email"
?>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Изменение Email</h5>

        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary my-2']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
