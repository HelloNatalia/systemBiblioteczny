<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Categories;
use backend\models\Autors;

$cat_items = Categories::find()
            ->select(['category_name'])
            ->indexBy('id')
            ->column();

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($books, 'title')->textInput()?>

<?= $form->field($autors, 'name')->textInput()?>
<?= $form->field($autors, 'surname')->textInput()?>

<?= $form->field($autors, 'country')->dropdownList([
    'Poland' => 'Poland',
    'Germany' => 'Germany',
    'United Kingdom' => 'United Kingdom'
], ['prompt' => "Select author's country"])?>

<?= $form->field($books, 'category_id')->dropdownList([$cat_items],
    ['prompt' => 'Select Category'])->label('Category')?>

<?= $form->field($books, 'publ_year')->textInput(['type' => 'number', ['maxlength' => 4]])->label('Publication year')?>

<?= $form->field($books, 'description')->textArea()?>
<?= $form->field($books, 'img')->fileinput(['multiple' => false, 'accept' => 'image/*'])?>
<?= $form->field($books, 'quantity')->textInput(['type' => 'number'])?>

<?= Html::submitButton('Post')?>

<?php ActiveForm::end()?>






