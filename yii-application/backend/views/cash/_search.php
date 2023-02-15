<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

// Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')])

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Borrow::find()->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')])->all(), 'id', 'id'),
    'options' => ['placeholder' => 'Wyszukaj nr wypożyczenia...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Nr wypożyczenia") ?>
<?= $form->field($searchModel, 'reader_id')->widget(Select2::classname(), [
    'data' => $borrowsData['readersData'],
    'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Czytelnik") ?>

<?= $form->field($searchModel, 'book_id')->widget(Select2::classname(), [
    'data' => $borrowsData['booksData'],
    'options' => ['placeholder' => 'Wyszukaj książkę...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Książka") ?>
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

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>