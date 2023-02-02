<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'name')->textInput()?>
<?= $form->field($searchModel, 'surname')->textInput()?>
<?= $form->field($searchModel, 'country')->dropdownList([
    'Poland' => 'Poland',
    'Germany' => 'Germany',
    'United Kingdom' => 'United Kingdom'
], ['prompt' => "Author's country"])?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['authors', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>
