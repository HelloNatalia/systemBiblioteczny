<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Aktualny status dostępnych książek</p>
        </div>
    </div>
    <?= $this->render('_search_b', ['searchModel' => $searchModel])?>
    <div class="row mt-4">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <td>ID</td>
                    <td>Tytuł</td>
                    <td>Autor</td>
                    <td>Rok wydania</td>
                    <td>Kategoria</td>
                    <td>Ilość</td>
                </thead>
                <tbody>
                    <?php foreach($models as $model) { ?>
                        <tr>
                            <th><?=$model->id?></th>
                            <td><?=$model->title?></td>
                            <td><?=$model->autor->name?> <?=$model->autor->surname?></td>
                            <td><?=$model->publ_year?></td>
                            <td><?=$model->category->category_name?></td>
                            <td><?=$model->quantity?> szt.</td>
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
