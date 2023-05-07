<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\event\models\EventPattern $model */

$this->title = 'Create Event Pattern';
$this->params['breadcrumbs'][] = ['label' => 'Event Patterns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-pattern-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
