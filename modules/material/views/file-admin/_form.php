<?php

use app\models\UploadForm;
use app\modules\material\models\Material;
use app\modules\material\models\Tag;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var UploadForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'files[]')->widget(FileInput::class, [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'showUpload' => false,
            'browseLabel' => 'Выберите файлы',
            'removeLabel' => 'Удалить',
            'overwriteInitial' => false,
            'maxFileSize' => 2000,
        ]
    ]) ?>

    <div class="form-group" role="group"">
        <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success']) ?>
    </div>

<?php $form = ActiveForm::end(); ?>
</div>
