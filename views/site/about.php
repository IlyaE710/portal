<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\widgets\sidebar\SidebarWidget;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

?>

<?= SidebarWidget::widget([
    'items' => [
        ['label' => 'Основная информация', 'url' => Url::to(['material-admin/update', 'id' => 0]), 'options' => ['class' => 'nav-link px-0 align-middle']],
        ['label' => 'Ссылки', 'url' => Url::toRoute(['link-admin/index', 'id' => 0]), 'options' => ['class' => 'nav-link px-0 align-middle']],
        ['label' => 'Файлы', 'url' => Url::toRoute(['file-admin/index', 'id' => 0]), 'options' => ['class' => 'nav-link px-0 align-middle']],
        ['label' => 'Тексты', 'url' => Url::toRoute(['text-admin/index', 'id' => 0]), 'options' => ['class' => 'nav-link px-0 align-middle']],
    ]
]); ?>
