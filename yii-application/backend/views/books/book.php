<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="container mt-5">
    <div class="row justify-items-center">
        <div class="col-7 col-sm-5 col-md-4 col-lg-3">
            <?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 200px', 'class' => 'ms-1'])?>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <p class="display fs-1"><?=$model->title?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="display-5 fs-2"><?=$model->autor->name?> <?=$model->autor->surname?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <a href="<?=Url::to(['update', 'id' => $model->id])?>"><button class="btn btn-dark btn-md mt-2 ms-1">Edytuj</button></a>
                    <a href="<?= Url::to(['delete-view', 'id' => $model->id])?>"><button class="btn btn-danger btn-md mt-2 ms-1">Usuń</button></a>
                    <a href="<?= Url::to(['borrow/create', 'id' => $model->id, 'reader' => ''])?>"><button class="btn btn-success btn-md mt-2 ms-1">Wypożycz</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-12 col-lg-8">
            <p class="display-5 fs-5">
                <p class="display fs-4">Opis</p>
                <?=$model->description?>
            </p>
        </div>
        <div class="col-12 col-lg-3 ms-2 ms-lg-3 me-3">
            <table class="table table-bordered">
                <tr>
                    <th scope="col">Kategoria</th>
                    <td><?=$model->category->category_name?></td>
                </tr>
                <tr>
                    <th scope="col">Rok wydania</th>
                    <td><?=$model->publ_year?></td>
                </tr>
                <tr>
                    <th scope="col">ID</th>
                    <td><?=$model->id?></td>
                </tr>
            </table>
        </div>
    </div>
</div>