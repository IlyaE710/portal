<?php
    use app\modules\curriculum\models\CurriculumPattern;
use app\modules\curriculum\models\SelectCurriculumForm;
use kartik\select2\Select2;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
/** @var SelectCurriculumForm $model */

$this->title = 'Выбор шаблона';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$models = CurriculumPattern::find()->all();
$data = [];

foreach ($models as $item) {
    $data[$item->id] = $item->subject->name . ' ' . $item->description;
}

?>
<div class="curriculum-create m-1">
    <div class="curriculum-form">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'idTemplate')->widget(Select2::class, [
            'data' => $data,
            'options' => ['placeholder' => 'Выбрать шаблон ...'],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-success my-2']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>