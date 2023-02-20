<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Autors;
use yii\helpers\ArrayHelper;
?>  


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>


<div class="row align-items-center justify-content-center">
    <div class="col-12 col-lg-6">
        <?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
            'data' => $authorsData,
            'options' => ['placeholder' => 'Wyszukaj autora...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <?= $form->field($searchModel, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Autors::find()->select('name')->orderBy(['name' => SORT_ASC])->distinct()->all(), 'name', 'name'),
            'options' => ['placeholder' => 'Wyszukaj imię...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-6 col-lg-3">
        <?= $form->field($searchModel, 'surname')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Autors::find()->select('surname')->orderBy(['surname' => SORT_ASC])->distinct()->all(), 'surname', 'surname'),
            'options' => ['placeholder' => 'Wyszukaj nazwisko...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-4">
        <?= $form->field($searchModel, 'country')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Autors::find()->select('country')->orderBy(['country' => SORT_ASC])->distinct()->all(), 'country', 'country'),
            'options' => ['placeholder' => 'Wyszukaj kraj pochodzenia...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-8 mt-4">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md'])?>
        <?= Html::a('Pokaż wszystko', ['authors', 'clear' => 1], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>

<?php ActiveForm::end()?>
