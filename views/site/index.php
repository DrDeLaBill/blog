<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Blog';
?>

<div class="row mb-4">
    <h2 class="col-6 tm-text-primary">
        Latest Articles
    </h2>
</div>
<div class="row tm-mb-90 tm-gallery">
    <?php
    foreach ($articles as $article): ?>
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
            <figure class="effect-ming tm-video-item" style="height: 150px;">
                <?= Html::img(
                    ($article->image) ? ('/uploads/' . $article->image) : '/default.jpg',
                    [
                        'class' => 'img-fluid',
                        'style' => 'background-repeat: no-repeat; background-position: -40px 0px; background-size: cover;'
                    ]
                ) ?>
                <figcaption class="d-flex align-items-center justify-content-center">
                    <h2><?= $article->title ?></h2>
                    <a href="#">View more</a>
                </figcaption>
            </figure>
            <h2><?= $article->title ?></h2>
            <div class="d-flex justify-content-between tm-text-gray">
                <span class="tm-text-gray-light"><?= $article->getDate() ?></span>
                <span><?= $article->viewed ?> views</span>
            </div>
        </div>
    <?php
    endforeach; ?>
</div>
<div class="row tm-mb-90">
    <div class="col-12 justify-content-between align-items-center tm-paging-col">
        <?php
        echo LinkPager::widget(
            [
                'pagination' => $pages,
                'hideOnSinglePage' => true,
                'prevPageLabel' => 'назад',
                'nextPageLabel' => 'далее',

                // Настройки контейнера пагинации
                'options' => [
                    'tag' => 'div',
                    'class' => 'tm-paging d-flex justify-content-center',
                    'id' => 'pager-container',
                ],

                // Настройки классов css для ссылок
                'linkOptions' => ['class' => 'tm-paging-link'],
                'activePageCssClass' => 'active',
                'disabledPageCssClass' => 'tm-paging-link',
                'disableCurrentPageButton' => true,


//                // Настройки для навигационных ссылок
                'prevPageCssClass' => '',
                'nextPageCssClass' => '',
            ]
        );
        ?>
    </div>
</div>