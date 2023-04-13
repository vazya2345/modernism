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
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Asosiy', 'url' => ['/site/index']],
            ['label' => 'Biz haqimizda', 'url' => ['/site/about']],
            ['label' => 'Bog‘lanish', 'url' => ['/site/contact']],
            [
                'label' => 'Ma\'lumot kiritish' ,
                'url' => ['/main/index'],
                'items' => [
                    ['label' => 'Obyektlar', 'url' => ['/admin/main/index']],
                    ['label' => 'Arhitektorlar', 'url' => ['/admin/architector/index']],
                    ['label' => 'Tadbirlar', 'url' => ['/admin/event/index']],
                    ['label' => 'Rasm', 'url' => ['/admin/photo/index']],
                    ['label' => 'Marshrut', 'url' => ['/admin/route/index']],
                    ['label' => 'Marshrut obyektlari', 'url' => ['/admin/route-object/index']],
                ],
            ],
            [
                'label' => 'API',
                'url' => ['/main/index'],
                'items' => [
                    ['label' => 'Main', 'url' => ['/main/index']],
                    ['label' => 'architector', 'url' => ['/architector/index']],
                    ['label' => 'event', 'url' => ['/event/index']],
                    ['label' => 'photo', 'url' => ['/photo/index']],
                    ['label' => 'route', 'url' => ['/route/index']],
                    ['label' => 'route-object', 'url' => ['/route-object/index']],
                ],
            ],
            Yii::$app->user->isGuest
                ? ['label' => 'Tizimga kirish', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Tizimdan chiqish (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
