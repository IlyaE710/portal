<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Link $model */
/** @var yii\widgets\ActiveForm $form */
/** @var string $material_id */
?>

<div class="link-form">
    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::toRoute(['admin/add-link', 'id' => $materialId]),
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!--    --><?php //= $form->field($model, 'material_id')->textInput(['value' => $material_id, 'readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить') ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
