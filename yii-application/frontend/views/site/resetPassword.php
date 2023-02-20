<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Resetowanie hasła</p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p>Wpisz nowe hasło:</p>
        </div>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
    <div class="row">
        <div class="col-5">
        <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label("Nowe hasło") ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
        <?= Html::submitButton('Zapisz', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
