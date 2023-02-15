<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Reader;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => $readersData,
    'options' => ['placeholder' => 'Wyszukaj czytelnika...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'name')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Reader::find()->select('name')->orderBy(['name' => SORT_ASC])->distinct()->all(), 'name', 'name'),
    'options' => ['placeholder' => 'Wyszukaj czytelników po imieniu...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'surname')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Reader::find()->select('surname')->orderBy(['surname' => SORT_ASC])->distinct()->all(), 'surname', 'surname'),
    'options' => ['placeholder' => 'Wyszukaj czytelników po nazwisku...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>