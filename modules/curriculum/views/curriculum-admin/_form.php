<?php

use app\modules\curriculum\models\Subject;
use app\modules\group\models\Group;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Curriculum $model */
/** @var yii\widgets\ActiveForm $form */

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-admin/update', 'id' => $id ?? $model->id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-admin/index', 'id' => $id ?? $model->id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>

<div class="curriculum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'image')->fileInput(); ?>

    <?= $form->field($model, 'subject')->widget(Select2::class, [
        'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select a tags ...'],
    ]); ?>

    <?= $form->field($model, 'group')->widget(Select2::class, [
        'data' => ArrayHelper::map(Group::find()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Выберите группу ...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>
    <?= Html::a(
        'Создать',
        Url::toRoute(['/group/group-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
    ); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'semester')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>