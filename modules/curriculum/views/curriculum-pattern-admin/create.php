<?php

use app\modules\curriculum\models\Subject;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */

$this->title = 'Create Curriculum Pattern';
$this->params['breadcrumbs'][] = ['label' => 'Curriculum Patterns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-pattern-create">

    <h1><?= Html::encode($this->title) ?></h1>

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