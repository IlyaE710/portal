<?php

use app\modules\curriculum\models\EventPattern;
use app\modules\curriculum\models\EventType;
use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var EventPattern $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['curriculum-pattern-admin/update', 'id' => $id ?? $model->curriculumId]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Меропрития', 'url' => Url::toRoute(['event-pattern-admin/index', 'id' => $id ?? $model->curriculumId]), 'options' => ['class' => 'nav-link px-0 align-middle']],
            ]
        ]); ?>
    </div>
    <div class="col-md-9">
        <?php \yii\widgets\Pjax::begin() ?>
        <div class="curriculum-pattern-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'type')->widget(Select2::class, [
                'data' => ArrayHelper::map(EventType::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выберите тэги ...'],
            ]); ?>
            <?= Html::a(
                'Создать',
                Url::toRoute(['event-type-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
            ); ?>

            <?= '<label class="control-label w-100">Материалы</label>'; ?>
            <?= $form->field($model, 'materials')->widget(Select2::class, [
                'data' => ArrayHelper::map(Material::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Выберите материалы ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ])->label(false); ?>

            <?= Html::a(
                'Создать',
                Url::toRoute(['/material/material-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
            ); ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            <?php \yii\widgets\Pjax::end() ?>
        </div>
    </div>
</div>
