<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <!-- saved from url=(0068)https://templatemo.com/templates/templatemo_556_catalog_z/index.html -->
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head() ?>
    </head>
    <body class="loaded">
    <?php
    $this->beginBody() ?>
    <!-- Page Loader -->
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <?= Html::a('Blog', ['/'], ['class' => 'navbar-brand']) ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?= Html::a('Home', ['/'], ['class' => "nav-link nav-link-1 active", 'aria-current' => "page"]) ?>
                    </li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="nav-item">
                            <?= Html::a('Login', ['/site/login'], ['class' => "nav-link nav-link-3"]) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Register', ['/site/register'], ['class' => "nav-link nav-link-4"]) ?>
                        </li>
                    <?php else: ?>
                        <?php if (Yii::$app->user->is_admin): ?>
                            <li class="nav-item">
                                <?= Html::a('Admin', ['/admin/default/index'], ['class' => "nav-link nav-link-4"]) ?>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <?= Html::a('Logout', ['/site/logout'], ['class' => "nav-link nav-link-2"]) ?>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="container">
            <?= Breadcrumbs::widget(
                [
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About Blog</h3>
                    <p>Blog is free <a rel="sponsored" href="https://v5.getbootstrap.com/">Bootstrap 5</a> Alpha 2
                        HTML Template.</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                        <li class="mb-2"><a href="https://facebook.com/"><i class="fab fa-facebook"></i></a></li>
                        <li class="mb-2"><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a href="https://instagram.com/meltwater.bottom"><i class="fab fa-instagram"></i></a></li>
                        <li class="mb-2"><a href="https://pinterest.com/"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="/js/plugins.js"></script>
    <script>
        $(window).on("load", function () {
            $('body').addClass('loaded');
        });
    </script>

    <?php
    $this->endBody() ?>
    </body>
    </html>
<?php
$this->endPage() ?>