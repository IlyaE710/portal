<?php

use app\modules\material\models\Material;
use app\widgets\sidebar\SidebarWidget;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var Material $model */

$this->title = 'Создание текста';
$this->params['breadcrumbs'][] = ['label' => 'Материалы', 'url' => ['material-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Материал', 'url' => ['material-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = ['label' => 'тексты', 'url' => ['index', 'id' => $id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <?= SidebarWidget::widget([
            'items' => [
                ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
                ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => $id]), 'options' => ['class' => 'nav-link px-0 align-middle']],
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
