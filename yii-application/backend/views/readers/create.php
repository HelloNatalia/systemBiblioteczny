<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;
use backend\models\Countries;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="container mt-4">
    <div class="row">
        <div class="col"><p class="display-5 fs-2">Dodaj nowego czytelnika</p></div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-md-6 col-lg-5">
            <?= $form->field($reader, 'name')->textInput()->label('Imię') ?>
        </div>
        <div class="col-12 col-md-6 col-lg-5">
            <?= $form->field($reader, 'surname')->textInput()->label('Nazwisko') ?>
        </div>
        <div class="col-6 col-lg-2">
            <?= $form->field($reader, 'birth_date')->widget(\yii\jui\DatePicker::classname()
                , [
                    'language' => 'pl',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'defaultDate' => date('2000-01-01'),
                        'changeMonth'=> true,
                        'changeYear'=> true,
                    ],
                    'options' => ['class' => 'form-control']
                ])->label('Data urodzenia') ?>
        </div>
        <div class="col-6 col-lg-4">
            <?= $form->field($reader, 'PESEL')->textInput(['type' => 'number'])->label('PESEL')?>
            <p><?php if($exists_info != "") {
                echo $exists_info; } ?></p>
        </div>
        <div class="col-6 col-lg-4">
            <?= $form->field($reader, 'email')->textInput()->label('E-mail') ?>
        </div>
        <div class="col-6 col-lg-4">
            <?= $form->field($reader, 'tel_number')->textInput(['type' => 'number'])->label('Numer telefonu')?>
        </div>
    </div>
    <div class="row">
        <hr class="mt-4 mb-4">
        <div class="col-12 col-lg-4">
            <?= $form->field($address, 'street')->textInput()->label('Ulica') ?>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <?= $form->field($address, 'home')->textInput()->label('Nr domu')?>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <?= $form->field($address, 'number')->textInput()->label('Nr mieszkania')?>
        </div>
        <div class="col-6 col-md-4">
            <?= $form->field($address, 'postal_code')->textInput(['type' => 'number', 'placeholder' => 'XXXXX'])->label('Kod pocztowy') ?>
        </div>
        <div class="col-6 col-md-6">
            <?= $form->field($address, 'city')->textInput()->label('Miasto') ?>
        </div>
        <div class="col-12 col-md-6">
            <?= $form->field($address, 'country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Countries::find()->select('name')->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),
                'options' => ['placeholder' => 'Wybierz kraj'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label("Kraj") ?>
        </div>
    </div>
    <div class="row">
        <div class="col mt-4">
            <?= Html::submitButton('Dodaj', ['class' => 'btn btn-success btn-md'])?>
        </div>
    </div>
</div>

<?php ActiveForm::end()?>



<style>
    div .help-block {
        color: red;
    }
    hr {
        height:4px; 
        width:100%; 
        border-width:0; 
        background-color:grey;
    }
</style>