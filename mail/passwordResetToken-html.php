<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

?>

<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($user->email) ?>,</p>


    <p><?= Html::encode('Выш пароль - ' . $password) ?> ?></p>
</div>