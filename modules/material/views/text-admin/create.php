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

<div class="create-text">
    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>
</div>
