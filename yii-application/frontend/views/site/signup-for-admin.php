<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
?>

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-7 col-md-6 col-lg-4">
            <p class="display-5 fs-2 mt-4">Stwórz konto admina</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-5">
            <p class="display-5 fs-5 mt-4">Proszę, wypełnij poniższe pola aby zarejestrować nowe konto:</p>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Nazwa użytkownika") ?>

                <?= $form->field($model, 'email')->label("E-mail") ?>
                <?= $form->field($model, 'password')->passwordInput()->label("Hasło") ?>

                <div class="form-group">
                    <?= Html::submitButton('Zarejestruj', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

