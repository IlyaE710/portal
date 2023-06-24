<?php

use app\modules\curriculum\models\EventPattern;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var EventPattern $model */

$this->title = 'Редактирование: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['curriculum-teacher/index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['curriculum-teacher/update', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index', 'id' => $model->curriculumId]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятие', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
