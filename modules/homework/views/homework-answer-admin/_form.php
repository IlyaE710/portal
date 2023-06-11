<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\HomeworkAnswer $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="homework-answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'comment')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        ],
    ])
        ->label(false); ?>

    <?= $form->field($model, 'mark')->dropDownList([
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            'Зачет' => 'Зачет',
            'Незачет' => 'Незачет',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
