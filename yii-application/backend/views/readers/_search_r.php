<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Borrow::find()->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['borrow.returned' => 0])->andWhere(['borrow.reader_id' => $id])->orderBy(['books.title' => SORT_ASC])->all(), 'book.id', 'book.title'),
    'options' => ['placeholder' => 'Wyszukaj tytułu'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("Tytuł") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['reader', 'clear' => 1, 'id' => $id], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>