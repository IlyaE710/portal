<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Информация о пользователе</h5>
                    <p class="card-text"><strong>Фамилия:</strong> <?= Html::encode($model->lastname) ?></p>
                    <p class="card-text"><strong>Имя:</strong> <?= Html::encode($model->firstname) ?></p>
                    <p class="card-text"><strong>Отчество:</strong> <?= Html::encode($model->patronymic) ?></p>
                    <p class="card-text"><strong>Email:</strong> <?= Html::encode($model->email) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= count($model->groups) > 1 ? 'Группы' : 'Группа' ?></h5>
                    <?php foreach($model->groups as $group): ?>
                        <p class="card-text"><strong><?= Html::encode($group->name) ?></strong></p>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Редактирование</h5>
                    <p class="card-text"><strong>Основные:</strong> <?= Html::a('изменить', Url::to(['change-email'])); ?></p>
                    <p class="card-text"><strong>Пароль:</strong> <?= Html::a('изменить', Url::to(['change-password'])); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
