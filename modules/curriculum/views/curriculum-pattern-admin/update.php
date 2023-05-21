<?php

use app\widgets\sidebar\SidebarWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\CurriculumPattern $model */

$this->title = 'Редактирование';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>

