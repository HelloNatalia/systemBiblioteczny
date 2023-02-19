<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="row">
    <div class="col-8 col-lg-5 mt-4">
        <?= $form->field($searchModel, 'borrow_id')->widget(Select2::classname(), [
            'data' => $borrowsData,
            'options' => ['placeholder' => 'Wyszukaj konkretny rekord...', 'multiple' => false],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-4 col-lg-3 mt-4">
        <?= $form->field($searchModel, 'returned_date')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['placeholder' => 'Data Zapłaty...', 'class' => 'form-control']
        ])->label(false) ?>
    </div>
    <div class="col">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md mt-4'])?>
        <?= Html::a('Pokaż wszystko', [$page, 'clear' => 1], ['class' => 'btn btn-dark btn-md mt-4']) ?>
    </div>
</div>

<?php ActiveForm::end()?>