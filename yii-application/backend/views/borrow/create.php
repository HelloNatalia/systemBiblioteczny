<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($borrow, 'reader_id')->widget(Select2::classname(), [
    'data' => $r_items,
    'options' => ['placeholder' => 'Wybierz czytelnika'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Czytelnik") ?>
<?= $form->field($borrow, 'book_id')->widget(Select2::classname(), [
    'data' => $b_items,
    'options' => ['placeholder' => 'Wybierz książkę'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Książka") ?>

<?= $form->field($days, 'quantity')->textInput(['type' => 'number', 'value' => 30])?>

<?= Html::submitButton('Dodaj')?>

<?php ActiveForm::end()?>