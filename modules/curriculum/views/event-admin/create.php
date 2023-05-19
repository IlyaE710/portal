<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\modules\curriculum\models\Event $model */

$this->title = 'Создать мероприятие';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['/curriculum/curriculum-admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Курс', 'url' => ['/curriculum/curriculum-admin/update', 'id' => $id]];
$this->params['breadcrumbs'][] = ['label' => 'Мероприятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
