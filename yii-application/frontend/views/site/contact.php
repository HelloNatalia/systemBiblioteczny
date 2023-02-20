<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 me-4">
            <p class="display-5 fs-2 mt-4">Kontakt</p>
            <p>Jeżeli masz jakieś pytania lub chcesz zostać naszym czytelnikiem i wypełnić formularz online, skontaktuj się z nami poprzez poniższy formularz. Dziękujemy. </p>
        
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
            <div class="row">
                <div class="col"><?= $form->field($model, 'name')->textInput(['autofocus' => true])->label("Imię i nazwisko") ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $form->field($model, 'email')->label("E-mail") ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $form->field($model, 'subject')->label("Temat") ?></div>
            </div>
            <div class="row">
                <div class="col"><?= $form->field($model, 'body')->textarea(['rows' => 6])->label("Treść") ?></div>
            </div>
            <div class="row">
                <div class="col">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])->label("Kod weryfikacyjny") ?>
                </div>
            </div>
            <div class="row mt-2 mb-4">
                <div class="col"><?= Html::submitButton('Wyślij', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?></div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-12 col-md-5 mt-5">
            <div class="row">
                <iframe class="ms-5 rounded-4" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1413.3229377220352!2d14.56403986565224!3d53.434203314840246!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spl!2spl!4v1676857074951!5m2!1spl!2spl" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p class="display-5 fs-5 fs-lg-4 mt-4 ms-5">ul. Teofila Starzyńskiego 256A</p>
                <p class="display-5 fs-5 fs-lg-4 ms-5">70-506 Szczecin, Polska</p>
                <p class="display-5 fs-5 fs-lg-6 mt-3 ms-5">Nr tel.: +48 111 222 333</p>
                <p class="display-5 fs-5 fs-lg-4 ms-5">E-mail: biblioteka@ksiazki.com</p>
            </div>
        </div>
    </div>
</div>
