<?php

use yii\helpers\Html;

?>
<div class="container-fluid tm-mt-60">
    <div class="row mb-4">
        <h2 class="col-12 tm-text-primary">
            <?= $article->title ?>
        </h2>
    </div>
    <div class="row tm-mb-74 tm-row-1640">
        <div class="col-lg-5 col-md-6 col-12 mb-3">
            <?= Html::img(
                ($article->image) ? ('/uploads/' . $article->image) : '/default.jpg',
                [
                    'class' => 'img-fluid',
                    'style' => 'background-repeat: no-repeat; background-position: -40px 0px; background-size: cover;'
                ]
            ) ?>
        </div>
        <div class="col-lg-7 col-md-6 col-12">
            <div class="tm-about-img-text">
                <p class="mb-4">
                    Category: <?= $article->category->title ?>
                </p>
                <p class="mb-4">
                    Date: <?= $article->getDate() ?>
                </p>
                <p class="mb-4">
                    <?= $article->content ?>
                <p>
            </div>
        </div>
    </div>
</div>
