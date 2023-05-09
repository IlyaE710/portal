<?php

use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="d-flex gap-1">
    <p>
        <?= Html::a('Материалы', Url::toRoute(['material/material-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Шаблоны учебных планов', Url::toRoute(['curriculum/curriculum-pattern-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Учебные планы', Url::toRoute(['curriculum/curriculum-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Тэги', Url::toRoute(['material/tag-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Предметы', Url::toRoute(['curriculum/subject-admin']), ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Тип мероприятия', Url::toRoute(['curriculum/event-type-admin']), ['class' => 'btn btn-success']) ?>
    </p>
</div>