<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Reader;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<div class="row">
    <div class="col-12 col-lg-6">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => $readersData,
            'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <?= $form->field($searchModel, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Reader::find()->select('name')->orderBy(['name' => SORT_ASC])->distinct()->all(), 'name', 'name'),
            'options' => ['placeholder' => 'Wyszukaj imię...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <?= $form->field($searchModel, 'surname')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Reader::find()->select('surname')->orderBy(['surname' => SORT_ASC])->distinct()->all(), 'surname', 'surname'),
            'options' => ['placeholder' => 'Wyszukaj nazwisko...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col mt-3 mb-3">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md me-2'])?>
        <?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>

<?php ActiveForm::end()?>