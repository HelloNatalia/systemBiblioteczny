<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="container p-2">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Czy na pewno chcesz usunąć tą książkę?</p>
        </div>
    </div>
    <div class="row justify-items-center mt-5">
        <div class="col-7 col-sm-5 col-md-4 col-lg-3">
            <?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 200px', 'class' => 'ms-1'])?>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-7">
            <div class="row">
                <div class="col">
                    <p class="display fs-1"><?=$model->id?>. <?=$model->title?></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="display-5 fs-2"><?=$model->autor->name?> <?=$model->autor->surname?></p>
                </div>
                <div class=" col-0 col-md-12">
                    <p class="display-5 fs-5"><?=$model->category->category_name?>, <?=$model->publ_year?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <a href="<?=Url::to(['delete', 'id' => $model->id])?>"><button class="btn btn-danger btn-md me-3">Tak, usuń</button></a>
            <a href="<?=Url::to(['index'])?>"><button class="btn btn-dark btn-md">Nie, przejdź do książek</button></a>
        </div>
    </div>
</div>



