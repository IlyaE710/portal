<?php

use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Админ панель';
?>

<div class="row">
    <p>Основные</p>
    <p class="col-auto">
        <?= Html::a('Материалы', Url::toRoute(['material/material-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Шаблоны курсов', Url::toRoute(['curriculum/curriculum-pattern-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Курсы', Url::toRoute(['curriculum/curriculum-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Профиль', Url::toRoute(['profile/profile']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Группа', Url::toRoute(['group/group-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Д/З', Url::toRoute(['homework/homework-answer-admin']), ['class' => 'btn btn-success']) ?>
    </p>
</div>
<div class="row">
    <p>Справочники</p>
    <p class="col-auto">
        <?= Html::a('Тэги', Url::toRoute(['material/tag-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Тип мероприятия', Url::toRoute(['curriculum/event-type-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p class="col-auto">
        <?= Html::a('Предметы', Url::toRoute(['curriculum/subject-admin']), ['class' => 'btn btn-success']) ?>
    </p>
</div>