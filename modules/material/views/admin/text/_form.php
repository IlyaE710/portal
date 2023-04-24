<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Text $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="text-form">
    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::toRoute(['admin/add-text', 'id' => $materialId]),
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
