<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>

<div class="container">
    <div class="row site-row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=books%2Findex">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/books.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Książki</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=books%2Fauthors">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/authors.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Autorzy</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=borrow%2Findex">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/borrows.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Wypożyczenia</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=readers%2Findex">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/readers.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Czytelnicy</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=cash%2Findex">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/cash.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Należności</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="index.php?r=reports%2Findex">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/site-img/reports.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Raporty</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>