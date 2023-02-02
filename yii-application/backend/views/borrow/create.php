<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Reader;
use backend\models\Books;


$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($borrow, 'reader_id')->dropdownList([$r_items],
    ['prompt' => 'Wybierz czytelnika'])->label('ID czytelnika')?>

<?= $form->field($borrow, 'book_id')->dropdownList([$b_items],
    ['prompt' => 'Wybierz książkę'])->label('Książka')?>

<?= $form->field($days, 'quantity')->textInput(['type' => 'number', 'value' => 30])?>

<?= Html::submitButton('Dodaj')?>

<?php ActiveForm::end()?>