<?php
/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\DateTime;
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Suma należności: <span class="text-success display-5 fs-1 fw-bold"><?=$totalincome?> zł</span></p>
        </div>
    </div>
    <?= $this->render('_search', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData])?>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <td>ID</td>
                        <td>
                            Data wypożyczenia <?= Html::a('&#129169;', ['index', 'sort' => 'd1asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd1desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>
                            Data zwrotu <?= Html::a('&#129169;', ['index', 'sort' => 'd2asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd2desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>Czytelnik</td>
                        <td>Książka</td>
                        <td>Po terminie</td>
                        <td>Do zapłaty</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($models as $model) {
                        $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
                        $datetime = new \DateTime($datetime ->format('Y-m-d 23:59:00')); 
                        $returndate = new \DateTime($model->return_date);
                        $days = (date_diff($datetime, $returndate));
                        $days = $days->format('%a'); 
                        $pricetopay = $days * $price->priceperday;
                        ?>
                        <tr>
                            <th><?=$model->id?></td>
                            <td><?=$model->date_time?></td>
                            <td><?=$model->return_date?></td>
                            <td><a href="<?=Url::to(['/readers/reader', 'id' => $model->reader->id])?>" class="text-decoration-none text-reset"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></a></td>
                            <td><a href="<?=Url::to(['/books/book', 'id' => $model->book->id])?>" class="text-decoration-none text-reset"><?=$model->book->id?> <?=$model->book->title?></a></td>
                            <td><?=$days?></td>
                            <td><?=$pricetopay?> zł</td>
                            <td>
                                <a href="<?=Url::to(['pay', 'id' => $model->id])?>"><button class="btn btn-danger btn-sm">Rozlicz</button></a>
                            </td>
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





    