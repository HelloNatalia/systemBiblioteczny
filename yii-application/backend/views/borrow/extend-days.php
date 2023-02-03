<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h2>Na ile dni przedłużyć?</h2>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($days, 'quantity')->textInput(['type' => 'number', 'value' => 30])?>

<?= Html::submitButton('Przedłuż')?>

<?php ActiveForm::end()?>