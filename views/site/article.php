<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
    <?php
    foreach ($comments as $comment): ?>
        <div class="row tm-50">
            <div class="col-lg-6 col-12">
                <h2 class="tm-text-primary">
                    <?= Html::img(
                        ($article->user->image) ? ('/uploads/' . $article->user->image) : '/default.jpg',
                        [
                            'class' => 'comment-photo-img',
                            'style' => 'background-repeat: no-repeat; background-position: -40px 0px; background-size: cover;'
                        ]
                    ) ?>
                    <?= $comment->user->username ?>
                </h2>
                <h3 class="mb-0"><p class="mb-0"> <?= $comment->text ?> </p></h3>
                <p> <?= $comment->getDate() ?> </p>
            </div>
        </div>
    <?php
    endforeach; ?>

    <div class="col-mx-6 my-4">
        <h2>Leave a comment</h2>
    </div>

    <?php
    $form = ActiveForm::begin(
        [
            'id' => 'comment-form',
            'layout' => 'horizontal',
            'action' => ['site/comment', 'article_id' => $article->id],
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]
    ); ?>

    <?= $form->field($commentForm, 'text')->textarea()->label(false) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            <?= Html::a('Change avatar', ['site/user-image'], ['class' => 'btn btn-primary mx-2']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>



</div>
