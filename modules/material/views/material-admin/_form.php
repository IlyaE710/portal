<?php

use app\modules\material\models\Material;
use app\modules\material\models\Tag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Material $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags')->widget(Select2::class, [
        'data' => ArrayHelper::map(Tag::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Выберите тэги ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 19]) ?>

    <div class="form-group" role="group"">
    <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success']) ?>
</div>

<?php $form = ActiveForm::end(); ?>
</div>
