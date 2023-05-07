<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'test';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <nav class="sidebar col-md-3">
        <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div class="col-md-9">
        <h1>Заголовок страницы</h1>
        <p>Контент страницы здесь...</p>
    </div>
</div>
