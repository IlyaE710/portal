<?php

use yii\helpers\Url;
use yii\widgets\Menu; ?>

<?= Menu::widget([
    'options' => [
        'class' => ['sidebar nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start'],
    ],
    'items' => $items,
]); ?>