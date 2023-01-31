<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($reader, 'name')->textInput() ?>
<?= $form->field($reader, 'surname')->textInput() ?>
<?= $form->field($reader, 'birth_date')->textInput(['placeholder' => 'yyyy-mm-dd']) ?>
<?= $form->field($reader, 'PESEL')->textInput(['type' => 'number'])?>
<?= $form->field($reader, 'email')->textInput() ?>
<?= $form->field($reader, 'tel_number')->textInput(['type' => 'number'])?>

<?= $form->field($address, 'street')->textInput() ?>
<?= $form->field($address, 'home')->textInput(['type' => 'number'])?>
<?= $form->field($address, 'number')->textInput(['type' => 'number'])?>
<?= $form->field($address, 'postal_code')->textInput(['placeholder' => 'XX-XXX']) ?>
<?= $form->field($address, 'city')->textInput() ?>
<?= $form->field($address, 'country')->textInput() ?>


<?= Html::submitButton('Post')?>

<?php ActiveForm::end()?>




