<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
<!--    --><?php
/*    NavBar::begin([
         'id' => 'header-main',
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Мои курсы', 'url' => ['/site/index']],
            ['label' => 'Админ', 'url' => ['/admin']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->email . ')',
                        ['class' => 'nav-link btn btn-link logout mr-auto']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    */?>

    <?php
    NavBar::begin([
        'brandLabel' => 'Учебный портал ВУЗа',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light mb-4',
        ],
    ]);

    // Определение пунктов меню слева
    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Календарь', 'url' => ['/site/calendar']],
        [
            'label' => '<i class="bi bi-person-fill"></i>', // Иконка пользователя
            'encode' => false,
            'items' => !Yii::$app->user->isGuest ? [
                !Yii::$app->user->isGuest ? Yii::$app->user->identity->role == 'admin'
                    ? ['label' => 'Админ панель', 'url' => ['/admin']]
                    : '' : '',
                !Yii::$app->user->isGuest ? Yii::$app->user->identity->role == 'teacher'
                    ? ['label' => 'Шаблоны курсов', 'url' => ['/curriculum/curriculum-pattern-teacher']]
                    : '' : '',
                !Yii::$app->user->isGuest ? Yii::$app->user->identity->role == 'teacher'
                    ? ['label' => 'Курсы', 'url' => ['/curriculum/curriculum-teacher']]
                    : '' : '',
                !Yii::$app->user->isGuest ? Yii::$app->user->identity->role == 'teacher'
                    ? ['label' => 'Домашнии задания', 'url' => ['/homework/homework-answer-admin/list']]
                    : '' : '',
                !Yii::$app->user->isGuest ? Yii::$app->user->identity->role == 'teacher'
                    ? ['label' => 'Материалы', 'url' => ['/material/material-admin']]
                    : '' : '',
                ['label' => 'Профиль', 'url' => ['/profile']],
                ['label' => 'Выход', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ] : [],
        ],
        // Добавьте остальные пункты меню по вашему выбору
    ];

    // Определение пункта меню пользователя

    // Вывод навигационных пунктов
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);

    // Закрытие навбара
    NavBar::end();
    ?>
</header>

<main id="main" class="container" role="main">
    <?= Alert::widget() ?>
    <div class="row">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <div class="col-lg-12 col-sm-8 col-xs-2 col-xl-12 mx-auto text-center my-4">
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            </div>
        <?php endif ?>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-8 col-xs-2 col-xl-12">
            <?= $content ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $this->params['sidebar'] ?? '' ?>
        </div>
    </div>
</main>
    </div>

<footer class="bg-light text-muted">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-4">
                <h3>Контакты</h3>
                <ul>
                    <li>Телефон: <?= Html::a(Yii::$app->params['supportTelephone'], 'tel:' . str_replace(['+', ' '], '', Yii::$app->params['supportTelephone'])) ?></li>
                    <li>Email: <?= Html::mailto(Yii::$app->params['supportEmail']); ?></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Полезные ссылки</h3>
                <ul>
                    <li><?= Html::a('Главная', ['/site/index/']) ?></li>
                    <li><?= Html::a('Курсы', ['/site/index/']) ?></li>
                    <li><?= Html::a('Календарь', ['/site/calendar/']) ?></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Социальные сети</h3>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#"><i class="fa fa-vk"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-light text-center py-2">
        <div class="container">
            <p class="mb-0 text-dark">&copy; 2023 Учебный Портал. Все права защищены.</p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
