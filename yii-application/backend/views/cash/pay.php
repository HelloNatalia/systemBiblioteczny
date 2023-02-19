<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Prices;

?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Rozliczenie</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-lg-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <td style="width: 170px" rowspan="4"><?= Html::img(Url::to('@web/books_img/' . $model->book->img), ['style' => 'width: 150px;']) ?></td>
                    <th>ID</td>
                    <td><?=$model->book->id?></td>
                </tr>
                <tr>
                    <th>Tytuł</td>
                    <td><?=$model->book->title?></td>
                </tr>
                <tr>
                    <th>Autor</td>
                    <td><?=$author->name?> <?=$author->surname?></td>
                </tr>
                <tr>
                    <th>Rok wydania</td>
                    <td><?=$model->book->publ_year?></td>
                </tr>
                <tr>
                    <td style="width: 170px" rowspan="4"><?= Html::img(Url::to('@web/assets/person.png'), ['style' => 'width: 150px;']) ?></td>
                    <th>Nr czytelnika</td>
                    <td><?=$model->reader->id?></td>
                </tr>
                <tr>
                    <th>Imię i nazwisko</td>
                    <td><?=$model->reader->name?> <?=$model->reader->surname?></td>
                </tr>
                <tr>
                    <th>PESEL</td>
                    <td><?=$model->reader->PESEL?></td>
                </tr>
                <tr>
                    <th>Nr telefonu</td>
                    <td><?=$model->reader->tel_number?></td>
                </tr>
            </table>
        </div>
        <div class="col-12 col-lg-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Data wypożyczenia</th>
                    <td><?=$model->date_time?></td>
                </tr>
                <tr>
                    <th>Planowana data zwrotu</th>
                    <td><?=$model->return_date?></td>
                </tr>
                <tr>
                    <th>Ilość przetrzymanych dni</th>
                    <td><?=$days?></td>
                </tr>
                <tr>
                    <th>Cena za dzień</th>
                    <td><?=$pricetopay/$days?> zł</td>
                </tr>
                <tr>
                    <th>Do zwrotu</th>
                    <td><?=$pricetopay?> zł</td>
                </tr>
            </table>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                            <a href="<?=Url::to(['borrow/end', 'id' => $model->id, 'days' => $days, 'price' => $pricetopay])?>"><button class="btn btn-success btn-md m-2">Zakończ</button></a>
                            </td>
                            <?php if($model->extend_quantity >= 2) { ?>
                            <td>
                                <p class="text-danger">Nie można już więcej przedłużyć.</p>
                            </td>
                            <?php } else { ?>
                                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
                                    <td>
                                        <div class="row m-2">
                                            <div class="col-7"><?= $form->field($qdays, 'quantity')->textInput(['type' => 'number', 'value' => 30, 'placeholder' => 'na ile dni przedłużyć?'])->label(false)?></div>
                                            <div class="col"><?= Html::submitButton('Przedłuż', ['class' => 'btn btn-dark btn-md'])?></div>
                                        </div>
                                    </td>
                                    <?php ActiveForm::end()?>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





