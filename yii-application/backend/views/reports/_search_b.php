<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Books;
use yii\helpers\ArrayHelper;
use backend\models\Autors;
use backend\models\Categories;

$authorsList = new Autors();

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="row">
    <div class="col-12 col-md-2 col-lg-1 mt-4">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Books::find()->select('id')->orderBy(['id' => SORT_ASC])->all(), 'id', 'id'),
            'options' => ['placeholder' => 'ID'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-5 col-lg-3 mt-4">
        <?= $form->field($searchModel, 'title')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Books::find()->select('title')->orderBy(['title' => SORT_ASC])->all(), 'title', 'title'),
            'options' => ['placeholder' => 'Wyszukaj tytuł książki...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-5 col-lg-3 mt-4">
        <?= $form->field($searchModel, 'autor_id')->widget(Select2::classname(), [
            'data' => $authorsList->getAuthorsList(),
            'options' => ['placeholder' => 'Wyszukaj autora...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-4 col-lg-2 mt-4">
        <?= $form->field($searchModel, 'publ_year')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Books::find()->select('publ_year')->orderBy(['publ_year' => SORT_ASC])->distinct()->all(), 'publ_year', 'publ_year'),
            'options' => ['placeholder' => 'Rok wydania...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-6 col-lg-3 mt-4">
        <?= $form->field($searchModel, 'category_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Categories::find()->all(), 'id', 'category_name'),
            'options' => ['placeholder' => 'Wyszukaj kategorię...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md mt-4 me-2'])?>
        <?= Html::a('Pokaż wszystko', ['status', 'clear' => 1], ['class' => 'btn btn-dark btn-md mt-4']) ?>
    </div>
</div>
<div class="row">
    <div class="col mt-5">
        <p>
            <b>Ilość w bibliotece: </b>
            <?= Html::a('&#129169;', ['status', 'sort' => 'asc'], ['class' => 'btn btn-dark btn-sm']) ?> 
            <?= Html::a('&#129171;', ['status', 'sort' => 'desc'], ['class' => 'btn btn-dark btn-sm']) ?>
        </p>
    </div>
</div>













<?php ActiveForm::end()?>