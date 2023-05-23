<?php

use app\modules\curriculum\models\Subject;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */
/** @var yii\widgets\ActiveForm $form */

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['curriculum-pattern-admin/update', 'id' => $id ?? $model->id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Меропрития',
            'url' => Url::toRoute(['event-pattern-admin/index', 'id' => $id ?? $model->id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-calendar-event"></i></div></a>'
        ],
    ],
]);
?>


<div class="row">
    <div class="curriculum-pattern-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'subject')->widget(Select2::class, [
            'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите прмедмет...'],
        ]); ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group my-2">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success my-2']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
