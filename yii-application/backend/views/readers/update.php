<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($reader, 'name')->textInput() ?>
<?= $form->field($reader, 'surname')->textInput() ?>
<?= $form->field($reader, 'birth_date')->widget(\yii\jui\DatePicker::classname()
    , [
        'language' => 'pl',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'defaultDate' => date('2000-01-01'),
            'changeMonth'=> true,
            'changeYear'=> true,
            ]
    ]) ?>
<?= $form->field($reader, 'PESEL')->textInput(['type' => 'number'])?>
<p><?php if($exists_info != "") {
    echo $exists_info; } ?></p>
<?= $form->field($reader, 'email')->textInput() ?>
<?= $form->field($reader, 'tel_number')->textInput(['type' => 'number'])?>

<?= $form->field($address, 'street')->textInput() ?>
<?= $form->field($address, 'home')->textInput(['type' => 'number'])?>
<?= $form->field($address, 'number')->textInput(['type' => 'number'])?>
<?= $form->field($address, 'postal_code')->textInput(['type' => 'number', 'placeholder' => 'XXXXX']) ?>
<?= $form->field($address, 'city')->textInput() ?>
<?= $form->field($address, 'country')->textInput() ?>


<?= Html::submitButton('Post')?>

<?php ActiveForm::end()?>