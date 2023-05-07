<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\event\models\EventType $model */

$this->title = 'Create Event Type';
$this->params['breadcrumbs'][] = ['label' => 'Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
