<?php

use app\modules\curriculum\models\EventType;
use app\modules\homework\models\Homework;
use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\modules\curriculum\models\Event $model */
/** @var yii\widgets\ActiveForm $form */

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-teacher/update', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-teacher/index', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="row">
    <div class="curriculum-pattern-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'typeId')->widget(Select2::class, [
            'data' => ArrayHelper::map(EventType::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите тип ...'],
            'disabled' => true,
        ]); ?>

        <?= $form->field($model, 'materials')->widget(Select2::class, [
            'data' => ArrayHelper::map(Material::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => 'Выберите материалы ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ]); ?>

        <?= Html::a(
            'Создать',
            Url::toRoute(['/material/material-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
        ); ?>

        <?= $form->field($model, 'homeworks')->widget(Select2::class, [
            'data' => ArrayHelper::map(Homework::find()->all(), 'id', 'title'),
            'options' => ['placeholder' => 'Выберите Д/З ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'multiple' => true,
            ],
        ]); ?>

        <?= Html::a(
            'Создать',
            Url::toRoute(['/homework/homework-admin/create']), ['target' => '_blank', 'data-pjax' => '0']
        ); ?>

        <?= $form->field($model, 'startDate')->widget(DateTimePicker::class, [
            'options' => ['placeholder' => 'Выберите дату начала ...'],
            'convertFormat' => true,
            'disabled' => true,
            'pluginOptions' => [
                'format' => 'y-MM-d H:i:00',
                'startDate' => 'now',
                'todayHighlight' => true,
                'autoclose' => true,
            ]
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success my-2']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
