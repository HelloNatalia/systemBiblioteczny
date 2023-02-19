<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Books;
use backend\models\Reader;
?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Spis wszystkich wpłat</p>
        </div>
    </div>
    <?= $this->render('_search_r', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData, 'page' => 'paid'])?>
    <div class="row mt-5">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <td>ID wypożyczenia</td>
                        <td>
                            Data wypożyczenia <?= Html::a('&#129169;', ['paid', 'sort' => 'd1asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd1desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>
                            Planowana data zwrotu <?= Html::a('&#129169;', ['paid', 'sort' => 'd2asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd2desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>
                            Data zapłaty<?= Html::a('&#129169;', ['paid', 'sort' => 'd3asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd3desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>Ilość przetrzymanych dni</td>
                        <td>Zapłacono</td>
                        <td>Czytelnik</td>
                        <td>Książka</td>
                        <td>Zwrócono</td>
                        <td>Przedłużono</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($models as $model) {  
                    $book = Books::find()->where(['id' => $model->borrow->book_id])->one();
                    $reader = Reader::find()->where(['id' => $model->borrow->reader_id])->one(); ?>
                    <tr>
                        <th><?=$model->borrow->id?></th>
                        <td><?=$model->borrow->date_time?></td>
                        <td><?=$model->borrow->return_date?></td>
                        <td><?=$model->returned_date?></td>
                        <td><?=$model->days?></td>
                        <td><?=$model->price?> zł</td>
                        <td><?=$reader->id?> <?=$reader->name?> <?=$reader->surname?></td>
                        <td><?=$book->id?> <?=$book->title?></td>
                        <?php if($model->extended == 1) { ?>
                            <td>NIE</td>
                            <td>TAK</td>
                        <?php } else { ?>
                            <td>TAK</td>
                            <td>NIE</td>
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
