<?php

use app\models\User;
use app\modules\curriculum\models\EventPattern;
use app\modules\curriculum\models\EventType;
use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var EventPattern $model */
/** @var yii\widgets\ActiveForm $form */

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-pattern-admin/update', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-pattern-admin/index', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
$isAdmin = Yii::$app->user->identity->role === 'admin';
?>

<div class="row">
    <div class="curriculum-pattern-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'typeId')->widget(Select2::class, [
            'data' => ArrayHelper::map(EventType::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите тэги ...'],
        ]); ?>

        <?php if ($isAdmin): ?>

            <?= Html::a(
                'Создать',
                Url::toRoute(['event-type-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
            ); ?>

        <?php endif; ?>

        <?= $form->field($model, 'lectorId')->widget(Select2::class, [
            'data' => ArrayHelper::map(User::find()->where(['role' => 'teacher'])->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Выберите лектора ...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
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
            'data' => ArrayHelper::map(\app\modules\homework\models\Homework::find()->all(), 'id', 'title'),
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
