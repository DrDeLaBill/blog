<?php

use yii\bootstrap\Html;

?>

<div class="admin-default-index">
    <h1>Admin panel</h1>

    <div class="row">
        <div class="col">
            <?= Html::a('Article settings', ['article/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            <?= Html::a('Comment settings', ['comment/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            <?= Html::a('Category settings', ['category/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            <?= Html::a('Tag settings', ['tag/index'], ['class' => 'btn btn-primary btn-lg btn-block']) ?>
        </div>
    </div>

</div>
