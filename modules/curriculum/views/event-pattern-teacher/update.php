<?php

use app\modules\curriculum\models\EventPattern;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var EventPattern $model */

$this->title = 'Редактирование: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны учебных планов', 'url' => ['curriculum-pattern-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблон', 'url' => ['curriculum-pattern-admin/update', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятие', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="event-pattern-update">

    <!--    <h1>--><?php //= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
