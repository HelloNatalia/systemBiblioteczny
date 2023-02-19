<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Returns;
?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Spis aktywnych przedłużeń</p>
        </div>
    </div>
    <?= $this->render('_search', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData, 'page' => 'extensions'])?>
    <div class="row mt-5">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <td>ID</td>
                        <td>
                            Data wypożyczenia <?= Html::a('&#129169;', ['extensions', 'sort' => 'd1asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['extensions', 'sort' => 'd1desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>
                            Nowa data zwrotu <?= Html::a('&#129169;', ['extensions', 'sort' => 'd2asc'], ['class' => 'btn btn-light btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['extensions', 'sort' => 'd2desc'], ['class' => 'btn btn-light btn-sm']) ?>
                        </td>
                        <td>Czytelnik</td>
                        <td>Książka</td>
                        <td>Po terminie</td>
                        <td>Należność</td>
                        <td>Zapłacono dnia</td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($models as $model) { ?>
                    <tr>
                        <th><?=$model->id?></th>
                        <td><?=$model->date_time?></td>
                        <td><?=$model->return_date?></td>
                        <td><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></td>
                        <td><?=$model->book->id?> <?=$model->book->title?></td>
                        <?php if($returnModel = Returns::find()->where(['borrow_id' => $model->id])->one()) { ?>
                            <td><?=$returnModel->days?> dni</td>
                            <td><?=$returnModel->price?> zł</td>
                            <td><?=$returnModel->returned_date?></td>
                        <?php } else {?>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
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

