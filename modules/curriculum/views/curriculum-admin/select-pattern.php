<?php
    use app\modules\curriculum\models\CurriculumPattern;
    use kartik\select2\Select2;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

$this->title = 'Выбор шаблона';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curriculum-create m-1">
    <div class="curriculum-form">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= Select2::widget([
            'name' => 'id',
            'data' => ArrayHelper::map(CurriculumPattern::find()->all(), 'id', 'description'),
            'options' => ['placeholder' => 'Выбрать шаблон ...'],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Далее', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>