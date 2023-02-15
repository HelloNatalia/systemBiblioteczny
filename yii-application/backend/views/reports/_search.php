<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Borrow::find()->select('id')->orderBy(['id' => SORT_ASC])->all(), 'id', 'id'),
    'options' => ['placeholder' => 'Nr wypożyczenia'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '170px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'reader_id')->widget(Select2::classname(), [
    'data' => $borrowsData['readersData'],
    'options' => ['placeholder' => 'Czytelnik'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '250px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'book_id')->widget(Select2::classname(), [
    'data' => $borrowsData['booksData'],
    'options' => ['placeholder' => 'Książka'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '250px'
    ],
])->label("") ?>

<?= $form->field($searchModel, 'date_time')->widget(\yii\jui\DatePicker::classname()
    , [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
<?= $form->field($searchModel, 'return_date')->widget(\yii\jui\DatePicker::classname()
    , [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

<?php if(isset($between)) { ?>
    <?= $form->field($searchModel, 'returned_date')->widget(\yii\jui\DatePicker::classname()
    , [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]) ?>
<?php } ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', [$page, 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>