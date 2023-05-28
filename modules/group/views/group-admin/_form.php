<?php

use app\models\User;
use app\modules\group\models\Group;
use kartik\select2\Select2;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\group\models\Group $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'users')->widget(Select2::class, [
        'data' => ArrayHelper::map(User::find()->all(), 'id', 'fullname'),
        'options' => ['placeholder' => 'Выберите студентов ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>