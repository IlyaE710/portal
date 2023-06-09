<?php

use app\modules\homework\models\FileUploadForm;
use app\modules\homework\models\Homework;
use app\modules\homework\models\HomeworkAnswer;
use kartik\file\FileInput;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var Homework $homework */
/** @var HomeworkAnswer $model */
/** @var HomeworkAnswer[] $oldAnswers */
$this->title = 'Домашнее задание';
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => Url::to(['/curriculum/curriculum/view', 'id' => $curriculumId])];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятие', 'url' => Url::to(['/curriculum/event/view', 'id' => $eventId])];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= 'Домашнее задание' .PHP_EOL . $homework->content ?>

<?php if (!$isBlockForm): ?>
<div class="homework-answer-form">

    <?php $form = ActiveForm::begin([
        'action' => \yii\helpers\Url::to(['index', 'eventId' => $eventId, 'curriculumId' => $curriculumId, 'homeworkId' => $homework->id])
    ]); ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class,[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        ],
    ])
        ->label(false); ?>

    <?= $form->field($model, 'files[]')->widget(FileInput::class, [
        'options' => ['multiple' => true],
        'pluginOptions' => [
            'previewFileType' => 'image',
            'showUpload' => true,
            'browseLabel' => 'Выберите файлы',
            'removeLabel' => 'Удалить',
            'overwriteInitial' => false,
        ]
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php endif; ?>
<div class="mb-4">
    <?php if(!empty($homework->answers)): ?>
        <?= Html::encode('Ответы'); ?>
        <?php foreach($homework->answers as $oldAnswer): ?>
        <?php if($oldAnswer->studentId === Yii::$app->user->id): ?>
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><?= $oldAnswer->content; ?></p>
                </div>
            </div>
            <?php if(!empty($oldAnswer->mark)): ?>
                <div class="mt-4">
                    <h5>Оценка</h5>
                    <div class="d-flex align-items-center">
                        <div class="rating">
                            <span class="badge bg-primary"><?= $oldAnswer->mark; ?></span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($oldAnswer->comment)): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Комментарий преподавателя</h5>
                        <p class="card-text"><?=$oldAnswer->comment; ?></p>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
