<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\event\models\EventPattern $model */

$this->title = 'Создать шаблон мероприятия';
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны мероприятий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-pattern-create">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
