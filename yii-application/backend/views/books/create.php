<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Categories;
use kartik\select2\Select2;
use backend\models\Countries;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<p class="display-5 fs-3 mt-3">Dodaj nową książkę</p>

<div class="form-group">
    <div class="row p-4 mt-2">
        <div class="col-12">
            <?= $form->field($books, 'title')->textInput()->label('Tytuł książki')?>
        </div>
        <div class="col-12 col-md-6 mt-3">
            <?= $form->field($autors, 'name')->textInput()->label('Imię autora')?>
        </div>
        <div class="col-12 col-md-6 mt-3">
            <?= $form->field($autors, 'surname')->textInput()->label('Nazwisko autora')?>
        </div>
        <hr class="mt-5 mb-4">
        <div class="col-12 col-md-5 col-lg-4 mt-3">
            <?= $form->field($autors, 'country')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Countries::find()->select('name')->orderBy(['name' => SORT_ASC])->all(), 'name', 'name'),
                'options' => ['placeholder' => 'Wybierz kraj'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label("Kraj pochodzenia autora") ?>
        </div>
        <div class="col-12 col-md-5 col-lg-4 mt-3">
            <?= $form->field($books, 'category_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Categories::find()->orderBy(['category_name' => SORT_ASC])->all(), 'id', 'category_name'),
                'options' => ['placeholder' => 'Wybierz kategorię'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])->label("Kategoria") ?>
        </div>
        <div class="col-12 col-md-2 col-lg-4 mt-3">
            <?= $form->field($books, 'publ_year')->textInput(['type' => 'number', ['maxlength' => 4]])->label('Rok')?>
        </div>
        <div class="col-12 mt-3">
            <?= $form->field($books, 'description')->textArea()->label('Opis')?>
        </div>
        <hr class="mt-5 mb-4">
        <div class="col-2 mt-3">
            <?= $form->field($books, 'quantity')->textInput(['type' => 'number'])->label('Ilość')?>
        </div>
        <div class="col-2 mt-3">
            <?= $form->field($books, 'img')->fileinput(['multiple' => false, 'accept' => 'image/*'])->label('Okładka')?>
        </div>
        <div class="col-8"></div>
        <div class="col-12 mt-4">
            <?= Html::submitButton('Utwórz nową książkę', ['class' => 'btn btn-success btn-md'])?>
        </div>
    </div>
</div>



<?php ActiveForm::end()?>

<style>
    div .help-block {
        color: red;
    }
    hr {
        height:4px; 
        width:100%; 
        border-width:0; 
        background-color:grey;
    }
</style>




