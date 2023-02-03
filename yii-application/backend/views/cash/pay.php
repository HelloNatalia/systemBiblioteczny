<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h2>Rozliczenie czytelnika <?=$model->reader->name?> <?=$model->reader->surname?>, ID: <?=$model->reader->id?></h2><br><br>

<p><b>Książka:</b></p>
<p>Tytuł: <?=$model->book->title?></p>
<p>Autor: <?=$author->name?> <?=$author->surname?></p><br><br>

<p><b>Data wypożyczenia: </b> <?=$model->date_time?></p>
<p><b>Planowana data zwrotu: </b> <?=$model->return_date?></p><br><br>

<p><b>Ilość przetrzymanych dni: </b> <?=$days?></p>
<h3><b>Do zwrotu: </b> <?=$pricetopay?> zł</h3><br><br>

<?php if($model->extend_quantity >= 2) { ?> 
    <p>Nie można już więcej przedłużyć.</p>
<?php } else { ?>
    <p><b>Na ile dni przedłużyć?</b></p>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
    <?= $form->field($qdays, 'quantity')->textInput(['type' => 'number', 'value' => 30])?>
    <?= Html::submitButton('Przedłuż')?>
    <?php ActiveForm::end()?>
<?php } ?>

<a href="<?=Url::to(['borrow/end', 'id' => $model->id, 'days' => $days, 'price' => $pricetopay])?>"><button>Zakończ wypożyczenie</button></a>