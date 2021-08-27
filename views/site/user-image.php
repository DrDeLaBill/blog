<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<div class="container-fluid tm-mt-60">

    <div class="row col-md-6">
        <h2 class="col-12 tm-text-primary form-group">Upload new user avatar:</h2>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($image, 'image')->fileInput(['class' => 'form-control'])->label(false) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
