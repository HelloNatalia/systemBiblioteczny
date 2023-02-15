<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Books;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'title')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Books::find()->select('title')->where(['autor_id' => $id])->orderBy(['title' => SORT_ASC])->all(), 'title', 'title'),
    'options' => ['placeholder' => 'Wyszukaj tytuł...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['author', 'clear' => 1, 'id' => $author->autor->id], ['class' => 'btn btn-primary btn-sm']) ?>

<?php ActiveForm::end()?>
