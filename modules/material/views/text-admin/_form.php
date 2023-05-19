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

$this->params['sidebar'] = SidebarWidget::widget([
    'items' => [
        [
            'label' => 'Основная информация',
            'url' =>  Url::to(['material-admin/update', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-person"></i></div></a>'
        ],
        [
            'label' => 'Ссылки',
            'url' =>  Url::to(['link-admin/index', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-link"></i></div></a>'
        ],
        [
            'label' => 'Файлы',
            'url' =>  Url::to(['file-admin/index', 'id' => $id ??$model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-file-earmark"></i></div></a>'
        ],
        [
            'label' => 'Тексты',
            'url' =>  Url::to(['text-admin/index', 'id' => $id ?? $model->material_id]),
            'options' => ['class' => 'nav-link px-0 align-middle text-center text-dark'],
            'template' => '<a href="{url}"><div class="sidebar-item" data-bs-toggle="tooltip" data-bs-placement="right" title="{label}"><i class="bi bi-card-text"></i></div></a>'
        ],
    ],
]);
?>

<div class="row">
    <div class="text-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'content')->widget(CKEditor::class,[
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            ],
        ])
            ->label(false); ?>

        <div class="form-group" role="group"">
        <?= Html::submitButton("Сохранить", ['class' => 'btn btn-success my-2']) ?>
    </div>

    <?php $form = ActiveForm::end(); ?>
</div>
