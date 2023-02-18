<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="container mt-4">
    <div class="row">
        <div class="col"><p class="display-5 fs-2">Dodaj nowe wypożyczenie</p></div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-lg-6">
            <?= $form->field($borrow, 'reader_id')->widget(Select2::classname(), [
                'data' => $r_items,
                'options' => ['placeholder' => 'Wybierz czytelnika'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label("Czytelnik") ?>
        </div>
        <div class="col-12 col-lg-6">
            <?= $form->field($borrow, 'book_id')->widget(Select2::classname(), [
                'data' => $b_items,
                'options' => ['placeholder' => 'Wybierz książkę'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label("Książka") ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-6 col-md-4 col-lg-2">
            <?= $form->field($days, 'quantity')->textInput(['type' => 'number', 'value' => 30])?>
        </div>
        <div class="col mt-4">
            <?= Html::submitButton('Dodaj', ['class' => 'btn btn-success btn-md'])?>
        </div>
    </div>
        
    
</div>

<?php ActiveForm::end()?>