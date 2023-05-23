<?php

use app\modules\curriculum\models\Subject;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
?>
<?php $form = ActiveForm::begin([
    'method' => 'get',
    'action' => ['index'], // Замените 'course/index' на действие вашего контроллера, отвечающего за отображение списка курсов
    'options' => [
        'data-pjax' => 1, // Включение PJAX
        'class' => 'pjax-filter' // Уникальный класс для фильтра
    ],
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'groupName')->widget(Select2::class, [
            'data' => ArrayHelper::map(Yii::$app->user->identity->groups, 'id', 'name'),
            'options' => ['class' => ['col'], 'placeholder' => 'Выберите группы ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ]); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'subject')->widget(Select2::class, [
            'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            'options' => ['class' => ['col'], 'placeholder' => 'Выберите предметы ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ]); ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary my-2']) ?>
</div>

<?php ActiveForm::end(); ?>
