<?php

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\homework\models\Homework $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="homework-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(); ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        ],
    ])
        ->label(false); ?>

    <div class="form-group" role="group"">
        <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success my-2']) ?>
    </div>

<?php $form = ActiveForm::end(); ?>

</div>
