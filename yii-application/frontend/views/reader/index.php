<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Autors;
use yii\DateTime;
use yii\widgets\LinkPager;

?>



<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3">
            <p class="display-5 fs-2 mt-4"><?=$model->name?> <?=$model->surname?></p>
        </div>
    </div>
    <div class="row mt-sm-3 mt-md-4">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-5 col-sm-6 sol-md-9 col-lg-6">
                    <p class="display-5 fs-4">Dane osobowe</p>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Nr</th>
                    <td><?=$model->id?></td>
                </tr>
                <tr>
                    <th>PESEL</th>
                    <td><?=$model->PESEL?></td>
                </tr>
                <tr>
                    <th>Nr telefonu</th>
                    <td><?=$model->tel_number?></td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td><?=$model->email?></td>
                </tr>
                <tr>
                    <th>Rok urodzenia</th>
                    <td><?=$model->birth_date?></td>
                </tr>
            </table>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-3 col-lg-2">
                    <p class="display-5 fs-4">Adres</p>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Ulica</th>
                    <td><?=$model->address->street?></td>
                </tr>
                <tr>
                    <th>Numer</th>
                    <td><?=$model->address->home?><?php if($model->address->number) echo '/' . $model->address->number; ?></td>
                </tr>
                <tr>
                    <th>Kod pocztowy</th>
                    <td><?=$model->address->postal_code?></td>
                </tr>
                <tr>
                    <th>Miasto</th>
                    <td><?=$model->address->city?></td>
                </tr>
                <tr>
                    <th>Kraj</th>
                    <td><?=$model->address->country?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="display-5 fs-4 mt-4">Wypożyczone książki: </p>
        </div>
    </div>
    <?= $this->render('_search_r', ['searchModel' => $searchModel, 'id' => $model->id])?>
    
    <?php foreach($books as $book) { 
        $author = Autors::find()->where(['id' => $book->book->autor_id])->one();
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $now = new \DateTime($now ->format('Y-m-d 23:59:00'));
        $book->date_time = substr($book->date_time, 0, 11) . '23:59:00';
        $borrow_date = new \DateTime($book->date_time);
        $return_date = new \DateTime($book->return_date);
        if($now > $return_date) $after_date = true;
        else $after_date = false;
        $left = (date_diff($return_date, $now))->format('%a');
        $days = (date_diff($return_date, $borrow_date));
        $days = $days->format('%a'); 
        $borrow_date = $borrow_date->format('Y-m-d');
        $return_date = $return_date->format('Y-m-d'); ?>

        <div class="row justify-content-center mt-3">
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 m-3">
                <div class="card" style="width: 14rem;">
                    <img class="card-img-left" src="<?=Url::to('@web/books_img/' . $book->book->img)?>" alt="Okładka książki">
                    <a href="<?=Url::toRoute(['books/book', 'id' => $book->book->id])?>" class="text-decoration-none text-reset">
                        <div class="card-body">
                            <h5 class="card-title fs-6"><?=$book->book->title?></h5>
                            <p class="card-text">
                                <?=$author->name?> <?=$author->surname?>
                                <p><?=$borrow_date?> - <?=$return_date?></p>
                            </p>
                            <p class="card-text">
                                <div class="row">
                                    <?php if($after_date) { ?>
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col">
                                                <p style="color: #b32b2e;"><b>Po terminie: <?=$left?> dni</b></p>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <a href="<?=Url::to(['cash/pay', 'id' => $book->id])?>"><button class="btn btn-danger btn-sm">Rozlicz</button></a>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col">
                                                <p><b>Zostało: <?=$days?> dni</b></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-5 col-lg-2">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'pageCssClass' => 'page-link',
            ]); ?>
        </div>
    </div>
</div>


