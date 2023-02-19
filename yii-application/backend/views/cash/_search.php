<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\select2\Select2;
use backend\models\Borrow;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>


<div class="row">
    <div class="col-4 col-lg-2">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Borrow::find()->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')])->all(), 'id', 'id'),
            'options' => ['placeholder' => 'Nr wypożyczenia...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-8 col-lg-4">
        <?= $form->field($searchModel, 'reader_id')->widget(Select2::classname(), [
            'data' => $borrowsData['readersData'],
            'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-lg-6">
        <?= $form->field($searchModel, 'book_id')->widget(Select2::classname(), [
            'data' => $borrowsData['booksData'],
            'options' => ['placeholder' => 'Wyszukaj książkę...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-6 col-lg-3">
        <?= $form->field($searchModel, 'date_time')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Data wypożyczenia...']
        ])->label("") ?>
    </div>
    <div class="col-6 col-lg-3">
        <?= $form->field($searchModel, 'return_date')->widget(\yii\jui\DatePicker::classname()
        , [
            'language' => 'en',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control', 'placeholder' => 'Data zwrotu...']
        ])->label("") ?>
    </div>
</div>
<div class="row mt-4 mb-5">
    <div class="col">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md'])?>
        <?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>

<?php ActiveForm::end()?>