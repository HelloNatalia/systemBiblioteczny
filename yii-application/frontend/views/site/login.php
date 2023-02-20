<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

// $this->title = 'Login';
// $this->params['breadcrumbs'][] = $this->title;
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

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("ID czytelnika") ?>

                <?= $form->field($model, 'password')->passwordInput()->label("Hasło") ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Zapamiętaj mnie") ?>

                <div class="my-1 mx-0" style="color:#999;">
                    Jeżeli zapomniałeś/aś hasła, możesz je <?= Html::a('zresetować', ['site/request-password-reset']) ?>.
                    <br>
                    Potrzebujesz nowego e-maila weryfikacyjnego? <?= Html::a('Wyślij jeszcze raz', ['site/resend-verification-email']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Zaloguj', ['class' => 'btn btn-success mt-3', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

