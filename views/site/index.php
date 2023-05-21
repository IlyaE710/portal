<?php

/** @var yii\web\View $this */
/** @var Curriculum $curriculum */
/** @var CurriculumSearch $searchModel */
/** @var Curriculum[] $models */

use app\modules\curriculum\models\Curriculum;
use app\modules\curriculum\models\CurriculumSearch;
use app\modules\curriculum\models\Subject;
use app\modules\group\models\Group;
use app\modules\material\models\Tag;
use kartik\select2\Select2;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
$this->title = 'Учебный портал ВУЗа';
\yii\widgets\Pjax::begin();
?>
<button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-filter" aria-expanded="false" aria-controls="widget1">
    Открыть фильтр
</button>
<div class="collapse" id="collapse-filter">
    <div class="row">
        <?php $form = ActiveForm::begin([
            'action' => ['index'], // замените 'index' на действие вашего контроллера, обрабатывающего поиск
            'method' => 'get',
        ]); ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($searchModel, 'groupName')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Yii::$app->user->identity->groups, 'id', 'name'),
                    'options' => ['class' => ['col'], 'placeholder' => 'Выберите группы ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($searchModel, 'subject')->widget(Select2::class, [
                    'data' => ArrayHelper::map(Subject::find()->all(), 'id', 'name'),
                    'options' => ['class' => ['col'], 'placeholder' => 'Выберите предметы ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => true,
                    ],
                ]); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="row my-4">
            <?php foreach($models as $curriculum): ?>
                <div class="col-md-4">
                    <a href="<?= \yii\helpers\Url::toRoute(['curriculum/curriculum/view', 'id' => $curriculum->id]) ?>" class="card-link">
                        <div class="card card-course">
                            <img src="https://via.placeholder.com/500x200" class="card-course-img-top" alt="Курс">
                            <div class="card-body card-course-body">
                                <h5 class="card-title card-course-title"><?= $curriculum->subject->name ?> (<?= $curriculum->group->name ?>)</h5>
                                <p class="card-text card-course-text"><?= $curriculum->description ?></p>
                            </div>
                        </div>
                    </a>
                </div>
    <?php endforeach; ?>
</div>
<?php
\yii\widgets\Pjax::end();
