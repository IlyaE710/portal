<?php

use app\modules\material\models\Material;
use app\modules\material\models\Tag;
use app\modules\material\models\Text;
use app\widgets\sidebar\SidebarWidget;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Text $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $model->material_id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
            ]
        ]); ?>
    </div>
    <div class="col-md-9">
        <div class="material-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'content')->widget(CKEditor::class,[
                'editorOptions' => [
                    'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                ],
            ]); ?>

            <div class="form-group" role="group"">
            <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success']) ?>
        </div>

        <?php $form = ActiveForm::end(); ?>
    </div>
    </div>
</div>
