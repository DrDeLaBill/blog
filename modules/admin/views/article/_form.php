<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'title'),
        [
            'options' => [$model->category_id => ['Selected' => true]]
        ]
    ) ?>

    <div class="form-check">
        <label class="control-label" for="tags">Tags</label>
        <?= Html::checkboxList(
            'tags',
            $selectedTags,
            $tags,
            [
                'class' => 'form-check-input',
            ]
        ) ?>
    </div>

    <?= $form->field($image, 'image')->fileInput(['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>
