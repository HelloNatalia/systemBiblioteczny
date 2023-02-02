<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>

<?= $form->field($searchModel, 'id')->textInput(['type' => 'number'])?>
<?= $form->field($searchModel, 'title')->textInput()?>
<?= $form->field($searchModel, 'publ_year')->textInput(['type' => 'number'])?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['index', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>
<p>
    <b>Ilość w bibliotece: </b>
    <?= Html::a('&#129169;', ['index', 'sort' => 'asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
    <?= Html::a('&#129171;', ['index', 'sort' => 'desc'], ['class' => 'btn btn-primary btn-sm']) ?>
</p>


<?php ActiveForm::end()?>
