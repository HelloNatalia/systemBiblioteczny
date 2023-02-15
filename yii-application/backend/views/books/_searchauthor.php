<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Autors;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => $authorsData,
    'options' => ['placeholder' => 'Wyszukaj autora...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= $form->field($searchModel, 'name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Autors::find()->select('name')->orderBy(['name' => SORT_ASC])->distinct()->all(), 'name', 'name'),
    'options' => ['placeholder' => 'Wyszukaj autorów po imieniu...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= $form->field($searchModel, 'surname')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Autors::find()->select('surname')->orderBy(['surname' => SORT_ASC])->distinct()->all(), 'surname', 'surname'),
    'options' => ['placeholder' => 'Wyszukaj autorów po nazwisku...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= $form->field($searchModel, 'country')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Autors::find()->select('country')->orderBy(['country' => SORT_ASC])->distinct()->all(), 'country', 'country'),
    'options' => ['placeholder' => 'Wyszukaj autorów po kraju pochodzenia...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['authors', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>
