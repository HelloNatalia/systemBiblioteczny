<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'title')->textInput()?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['author', 'clear' => 1, 'id' => $author->autor->id], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>
