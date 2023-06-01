<?php

use app\modules\curriculum\models\Subject;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */

$this->title = 'Создать шаблон курса';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-pattern-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="curriculum-pattern-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'subjectId')->widget(Select2::class, [
            'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите прмедмет...'],
        ]); ?>

        <?= Html::a(
            'Предметы',
            Url::toRoute(['subject-admin/index']), ['target' => '_blank', 'data-pjax' => '0']
        ); ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success my-2']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
