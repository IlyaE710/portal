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
?>


<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['curriculum-pattern-admin/update', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Меропрития', 'url' => Url::toRoute(['event-pattern-admin/index', 'id' => $model->id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
            ]
        ]); ?>
    </div>
    <div class="col-md-9">
        <div class="curriculum-pattern-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'subject')->widget(Select2::class, [
                'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выберите прмедмет...'],
            ]); ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
