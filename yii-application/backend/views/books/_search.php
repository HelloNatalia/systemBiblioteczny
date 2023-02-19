<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Books;
use backend\models\Categories;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<div class="row align-items-center justify-content-center">
    <div class="col-12 col-lg-8">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => $booksData,
            'options' => ['placeholder' => 'Wyszukaj książkę...',],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-lg-4">
        <?= $form->field($searchModel, 'autor_id')->widget(Select2::classname(), [
            'data' => $authorsData,
            'options' => ['placeholder' => 'Wyszukaj autora...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-6 col-lg-4">
        <?= $form->field($searchModel, 'publ_year')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Books::find()->select('publ_year')->orderBy(['publ_year' => SORT_ASC])->distinct()->all(), 'publ_year', 'publ_year'),
            'options' => ['placeholder' => 'Wyszukaj rok wydania...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-6 col-lg-4">
        <?= $form->field($searchModel, 'category_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Categories::find()->orderBy(['category_name' => SORT_ASC])->all(), 'id', 'category_name'),
            'options' => ['placeholder' => 'Wyszukaj kategorię...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-lg-4 mt-4">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md me-1'])?>
        <?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-dark btn-md me-1']) ?>
    </div>
    <div class="col-12 mt-3">
        <p class="fs-6">Sortuj według ilości: 
            <?= Html::a('&#129169;', ['index', 'sort' => 'asc'], ['class' => 'ms-2 btn btn-dark btn-sm', 'title' => 'Rosnąco']) ?> 
            <?= Html::a('&#129171;', ['index', 'sort' => 'desc'], ['class' => 'ms-1 btn btn-dark btn-sm', 'title' => 'Malejąco']) ?>
        </p>
    </div>
</div>



<?php ActiveForm::end()?>
