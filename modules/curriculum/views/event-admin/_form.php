<?php

use app\modules\curriculum\models\EventType;
use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Event $model */
/** @var yii\widgets\ActiveForm $form */

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' => Url::to(['curriculum-admin/update', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-admin/index', 'id' => $id ?? $model->curriculumId]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="event-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->widget(Select2::class, array(
        'data' => ArrayHelper::map(EventType::find()->all(), 'id', 'name'),
        'options' => array('placeholder' => 'Select a tags ...'),
    )); ?>

    <?= $form->field($model, 'materials')->widget(Select2::class, [
        'data' => ArrayHelper::map(Material::find()->all(), 'id', 'title'),
        'options' => ['placeholder' => 'Select a materials ...'],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'duration')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
