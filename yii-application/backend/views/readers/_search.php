<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>


<?= $form->field($searchModel, 'id')->textInput(['type' => 'number'])?>
<?= $form->field($searchModel, 'name')->textInput()?>
<?= $form->field($searchModel, 'surname')->textInput()?>


<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>