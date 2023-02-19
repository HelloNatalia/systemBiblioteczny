<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="row">
    <div class="col-4 col-lg-2 mt-4">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Borrow::find()->select('id')->orderBy(['id' => SORT_ASC])->all(), 'id', 'id'),
            'options' => ['placeholder' => 'Nr wypożyczenia'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-8 col-lg-5 mt-4">
        <?= $form->field($searchModel, 'reader_id')->widget(Select2::classname(), [
            'data' => $borrowsData['readersData'],
            'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
    <div class="col-12 col-lg-5 mt-4">
        <?= $form->field($searchModel, 'book_id')->widget(Select2::classname(), [
            'data' => $borrowsData['booksData'],
            'options' => ['placeholder' => 'Wyszukaj książkę...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label(false) ?>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4 mt-4">
        <?= $form->field($searchModel, 'date_time')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['placeholder' => 'Data wypożyczenia...', 'class' => 'form-control']
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-4 mt-4">
        <?= $form->field($searchModel, 'return_date')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['placeholder' => 'Planowana data zwrotu...', 'class' => 'form-control']
        ])->label(false) ?>
    </div>
    <div class="col-12 col-md-4 mt-4">
        <?php if(isset($between)) { ?>
            <?= $form->field($searchModel, 'returned_date')->widget(\yii\jui\DatePicker::classname()
            , [
                'language' => 'en',
                'dateFormat' => 'yyyy-MM-dd',
                'options' => ['placeholder' => 'Rzeczywista data zwrotu...', 'class' => 'form-control']
            ])->label(false) ?>
        <?php } ?>
    </div>
</div>
<div class="row mt-4">
    <div class="col">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md me-2'])?>
        <?= Html::a('Pokaż wszystko', [$page, 'clear' => 1], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>

<?php ActiveForm::end()?>