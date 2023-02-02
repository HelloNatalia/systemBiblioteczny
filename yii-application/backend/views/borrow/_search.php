<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>


<?= $form->field($searchModel, 'id')->textInput(['type' => 'number'])?>
<?= $form->field($searchModel, 'reader_id')->textInput(['type' => 'number'])?>
<?= $form->field($searchModel, 'book_id')->textInput(['type' => 'number'])?>
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