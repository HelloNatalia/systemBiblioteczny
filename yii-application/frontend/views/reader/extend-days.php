<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Borrow;

$model = Borrow::find()->where(['borrow.id' => $borrow_id])->leftJoin('reader', 'reader.id = borrow.reader_id')->one();

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<div class="container mt-4">
    <div class="row">
        <div class="col"><p class="display-5 fs-2">Na ile dni przedłużyć? (max. 30 dni)</p></div>
    </div>
    <div class="col-12 col-md-10 col-lg-7">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Książka</th>
                <td><?=$model->book->title?></td>
            </tr>
            <tr>
                <th>Aktualna data</th>
                <td><?=$model->date_time?> - <b><?=$model->return_date?></b></td>
            </tr>
        </table>
    </div>
    <div class="row mt-3">
        <div class="col-6 col-md-4 col-lg-2">
            <?= $form->field($days, 'quantity')->textInput(['type' => 'number', 'value' => 30])->label('Ilość dni')?>
        </div>
        <div class="col mt-4">
            <?= Html::submitButton('Przedłuż', ['class' => 'btn btn-success btn-md'])?>
        </div>
    </div>
</div>
<?php ActiveForm::end()?>







