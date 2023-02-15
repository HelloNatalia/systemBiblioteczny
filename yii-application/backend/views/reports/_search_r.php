<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'borrow_id')->widget(Select2::classname(), [
    'data' => $borrowsData,
    'options' => ['placeholder' => 'Wyszukaj konkretny rekord', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '900px',
    ],
])->label("Wypożyczenia") ?>
<?= $form->field($searchModel, 'returned_date')->widget(\yii\jui\DatePicker::classname()
    , [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label("Data zapłaty") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', [$page, 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>