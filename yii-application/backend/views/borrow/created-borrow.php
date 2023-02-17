<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="container mt-4">
    <div class="row">
        <div class="col"><p class="display-5 fs-2">Podsumowanie</p></div>
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
            </table>
        </div>
        <div class="col-12 col-lg-6">
            <table class="table table-bordered table-striped">
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
    </div>
    <div class="row mt-4">
        <div class="col">
            <a href="<?=Url::to(['index'])?>"><button class="btn btn-dark btn-md">Przejdź do wypożyczeń</button></a>
        </div>
    </div>
</div>