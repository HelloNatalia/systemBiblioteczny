<?php

/** @var yii\web\View$this  */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Ponowne wysłanie e-maila weryfikującego</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Wpisz swój e-mail, na który zostanie ponownie wysłany link weryfikacyjny.</p>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>
    <div class="row">
        <div class="col-5">
            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label("E-mail") ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?= Html::submitButton('Wyślij', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
