<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-5 col-md-4 col-lg-2">
            <p class="display-5 fs-2 mt-4">Stwórz konto</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-5">
            <p class="display-5 fs-5 mt-4">Proszę, wypełnij poniższe pola aby się zarejestrować:</p>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("ID czytelnika") ?>

                <?= $form->field($model, 'email')->label("E-mail") ?>
                <?= $form->field($model, 'password')->passwordInput()->label("Hasło") ?>

                <div class="form-group">
                <?= Html::submitButton('Zarejestruj się', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
