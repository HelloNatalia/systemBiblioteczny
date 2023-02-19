<?php

use yii\helpers\Url;
use yii\DateTime;
use yii\helpers\Html;
use yii\widgets\LinkPager;


?>


<div class="container mt-4">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2">Wypożyczenia:</p>
        </div>
    </div>
    <?= $this->render('_search', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData])?>
    <div class="row">
        <div class="col mt-3 mb-3">
            <a href="<?=Url::to(['create', 'id' => '', 'reader' => ''])?>"><button class="btn btn-success btn-md">Dodaj</button></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-4">
            <table class="table table-striped">
                <thead class="table-dark">
                    <td scope="col">ID</td>
                    <td scope="col">
                        Wypożyczenie <?= Html::a('&#129169;', ['index', 'sort' => 'd1asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd1desc'], ['class' => 'btn btn-light btn-sm']) ?>
                    </td>
                    <td scope="col">
                        Zwrot <?= Html::a('&#129169;', ['index', 'sort' => 'd2asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd2desc'], ['class' => 'btn btn-light btn-sm']) ?>
                    </td>
                    <td scope="col">Czytelnik</td>
                    <td scope="col">Książka</td>
                    <td scope="col"></td>
                </thead>
                <tbody>
                    <?php foreach($models as $model) { 
                        $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
                        $returndate = new \DateTime($model->return_date); ?>
                        <?php if($returndate < $datetime) { ?>
                            <tr style="background-color: #ff8085;">
                        <?php } else { ?>
                            <tr>
                        <?php } ?>
                            <th scope="row"><?=$model->id?></th>
                            <td><?=$model->date_time?></td>
                            <td><?=$model->return_date?></td>
                            <td><a href="<?=Url::to(['/readers/reader', 'id' => $model->reader->id])?>" class="text-decoration-none text-reset"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></a></td>
                            <td><a href="<?=Url::to(['/books/book', 'id' => $model->book->id])?>" class="text-decoration-none text-reset"><?=$model->book->id?> <?=$model->book->title?></a></td>
                            
                            <?php if($returndate < $datetime) { ?>
                                <td>
                                    <a href="<?=Url::to(['cash/pay', 'id' => $model->id])?>"><button class="btn btn-danger btn-sm">Rozlicz</button></a>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <?php if($model->extend_quantity >= 2) { ?>
                                        <button title="Nie można już przedłużyć" class="btn btn-dark btn-sm" disabled="disabled">Przedłuż</button>
                                    <?php } else if (((date_diff($returndate, $datetime))->format('%a')) > 14) { 
                                        $left = (date_diff($returndate, $datetime))->format('%a'); ?>
                                        <button class="btn btn-dark btn-sm" disabled="disabled">Przedłuż</button>
                                        <small>Możliwość przedłużenia za <?=$left-14?> dni</small>
                                    <?php } else { ?>
                                        <a href="<?=Url::to(['extend-days', 'id' => $model->id])?>"><button class="btn btn-dark btn-sm">Przedłuż</button></a>
                                    <?php } ?>
                                    <a href="<?=Url::to(['end', 'id' => $model->id, 'days' => 0, 'price' => 0])?>"><button class="btn btn-success btn-sm">Zakończ</button></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-8 col-md-5 col-lg-2">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'pageCssClass' => 'page-link',
            ]); ?>
        </div>
    </div>

</div>




