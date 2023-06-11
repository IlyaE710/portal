<?php

use app\modules\curriculum\models\EventType;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var EventType $model */

$this->title = 'Редактирование типа: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => ['/admin/']];
$this->params['breadcrumbs'][] = ['label' => 'Типы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="event-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
