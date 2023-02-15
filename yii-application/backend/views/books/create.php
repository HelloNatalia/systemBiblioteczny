<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Categories;
use kartik\select2\Select2;
use backend\models\Countries;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($books, 'title')->textInput()?>

<?= $form->field($autors, 'name')->textInput()?>
<?= $form->field($autors, 'surname')->textInput()?>

<?= $form->field($autors, 'country')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Countries::find()->select('name')->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),
    'options' => ['placeholder' => 'Wybierz kraj'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Kraj pochodzenia autora") ?>

<?= $form->field($books, 'category_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Categories::find()->orderBy(['category_name' => SORT_ASC])->all(), 'id', 'category_name'),
    'options' => ['placeholder' => 'Wybierz kraj'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Kategoria") ?>



<?= $form->field($books, 'publ_year')->textInput(['type' => 'number', ['maxlength' => 4]])->label('Publication year')?>

<?= $form->field($books, 'description')->textArea()?>
<?= $form->field($books, 'img')->fileinput(['multiple' => false, 'accept' => 'image/*'])?>
<?= $form->field($books, 'quantity')->textInput(['type' => 'number'])?>

<?= Html::submitButton('Post')?>

<?php ActiveForm::end()?>






