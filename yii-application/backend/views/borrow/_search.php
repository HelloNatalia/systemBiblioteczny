<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="row">
    <div class="col-12 col-md-3 col-lg-2">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Borrow::find()->select('id')->where(['returned' => 0])->orderBy(['id' => SORT_ASC])->all(), 'id', 'id'),
            'options' => ['placeholder' => 'Nr wypożyczenia...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-9 col-lg-5">
        <?= $form->field($searchModel, 'reader_id')->widget(Select2::classname(), [
            'data' => $borrowsData['readersData'],
            'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-lg-5">
        <?= $form->field($searchModel, 'book_id')->widget(Select2::classname(), [
            'data' => $borrowsData['booksData'],
            'options' => ['placeholder' => 'Wyszukaj książkę...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-4">
        <?= $form->field($searchModel, 'date_time')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Wyszukaj datę wypożyczenia...']
            
        ])->label('') ?>
    </div>
    <div class="col-12 col-md-4">
        <?= $form->field($searchModel, 'return_date')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Wyszukaj datę zwrotu...']
        ])->label('') ?>
    </div>
    <div class="col-12 col-lg-4 mt-4">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md'])?>
        <?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>













<?php ActiveForm::end()?>