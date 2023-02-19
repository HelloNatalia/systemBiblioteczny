<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>

<div class="container">
    <div class="row site-row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="<?=Url::to(['borrows'])?>">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/rborrows.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Wypożyczenia</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="<?=Url::to(['returns'])?>">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/rreturns.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Zwroty</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="<?=Url::to(['extensions'])?>">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/rextends.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Przedłużenia</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="<?=Url::to(['paid'])?>">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/rcash.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Należności</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <a class="text-reset text-decoration-none text-center" href="<?=Url::to(['status'])?>">
                <div class="card m-5 shadow">
                    <img class="card-img-top" src="<?=Url::to('@web/assets/rstatus.jpg')?>" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">Status</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>