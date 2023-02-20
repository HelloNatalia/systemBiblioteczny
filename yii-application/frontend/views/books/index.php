<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
// use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
$imagePath = \yii::getAlias('@imagesurl');
$imagePath1 = str_replace('\\', '/', $imagePath);
// Url::to($imagePath . '/books_img/' . $model->img)
?>

<?= $this->render('_submenubook', ['page' => 'index'])?>


<?= $this->render('_search', ['searchModel' => $searchModel, 'booksData' => $booksData, 'authorsData' => $authorsData])?>

<div class="container border-2 border-dark rounded">
    <div class="row justify-content-center">
        <?php foreach($models as $model) { ?>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 m-3">
                <div class="card" style="width: 14rem;">
                    <img class="card-img-left" src="<?=Url::to('@web/books_img/' . $model->img)?>" alt="Card image cap">
                    <a href="<?=Url::toRoute(['/books/book', 'id' => $model->id])?>" class="text-decoration-none text-reset">
                        <div class="card-body">
                            <h5 class="card-title fs-6"><?=$model->title?></h5>
                            <p class="card-text">
                                <?=$model->autor->name?> <?=$model->autor->surname?>
                                <?php if($model->quantity > 0){ ?>
                                    <p class="text-success">Zostało: <?=$model->quantity?> sztuk</p>   
                                <?php } elseif($model->quantity == 0) { ?>
                                    <p class="text-danger">Brak w bibliotece</p>
                                <?php } else { ?>
                                    <p class="text-danger">Brak w bibliotece</p>
                                <?php } ?>
                            </p>
                            
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
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



