<?php

use yii\bootstrap5\NavBar;
use yii\helpers\Url;
use yii\widgets\Menu; ?>

<div class="row flex-nowrap">
    <?php
    NavBar::begin([
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light']
    ]);
    ?>
    <?= Menu::widget([
        'options' => [
            'class' => ['sidebar nav nav-flush flex-sm-column flex-row collapse show'],
        ],
        'items' => $items,
    ]); ?>

    <?php NavBar::end();
    ?>

    <div class="popup col-sm-4" id="popup-2">
        <div class="popup-close" onclick="togglePopup('popup-2')">
            <i class="bi bi-x"></i>
        </div>
        <div class="popup-content">
            <h3 class="popup-title">Содержание</h3>
            <div class="row">
                <?php foreach($collapses as $collapse): ?>
                    <div class="col-sm-12"><a href="<?= $collapse['url']?>"><?= $collapse['label']?></a></div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>
<div class="overlay" onclick="closeAllPopups()"></div>

