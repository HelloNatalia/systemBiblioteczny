<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-3 col-md-2 col-lg-1">
            <p class="display-5 fs-2 mt-4">Zaloguj</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <p class="display-5 fs-5 mt-4">Proszę, wypełnij poniższe pola aby się zalogować:</p>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Nazwa użytkownika") ?>

                <?= $form->field($model, 'password')->passwordInput()->label("Hasło") ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Zapamiętaj mnie") ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>