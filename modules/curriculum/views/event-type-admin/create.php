<?php

use app\modules\curriculum\models\EventType;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var EventType $model */

$this->title = 'Создать мероприятие';
$this->params['breadcrumbs'][] = ['label' => 'Типы мероприятий', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
