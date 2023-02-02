<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->textInput(['type' => 'number'])?>
<?= $form->field($searchModel, 'title')->textInput()?>
<?= $form->field($searchModel, 'publ_year')->textInput(['type' => 'number'])?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>
