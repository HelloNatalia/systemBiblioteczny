<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Categories;

$cat_items = Categories::find()
            ->select(['category_name'])
            ->indexBy('id')
            ->column();

$form = ActiveForm::begin()?>

<?= $form->field($books, 'title')->textInput()?>
<?= $form->field($autors, 'name')->textInput()?>
<?= $form->field($autors, 'surname')->textInput()?>

<?= $form->field($autors, 'country')->dropdownList([
    1 => 'Poland',
    2 => 'Germany',
    3 => 'United Kingdom'
], ['prompt' => "Select author's country"])?>

<?= $form->field($books, 'category_id')->dropdownList([$cat_items],
    ['prompt' => 'Select Category'])->label('Category')?>

<?= $form->field($books, 'publ_year')->textInput(['type' => 'number'])->label('Publication year')?>
<?= $form->field($books, 'description')->textArea()?>
<?= $form->field($books, 'img')->fileinput()?>
<?= $form->field($books, 'quantity')->textInput(['type' => 'number'])?>

<?= Html::submitButton('Post')?>

<?php ActiveForm::end() ?>




