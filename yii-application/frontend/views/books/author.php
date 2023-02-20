<?php
use backend\models\Books;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$author = Books::find()->leftJoin('autors', 'autors.id = books.autor_id')->where('autor_id = ' . $id)->one();
?>

<div class="container p-2">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4"><?=$author->autor->name?> <?= $author->autor->surname?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-muted fs-4 display-5">Książki dostępne w naszej bibliotece: </p>
        </div>
    </div>
    <?= $this->render('_searchtitle_a', ['searchModel' => $searchModel, 'author' => $author, 'id' => $id])?>
    <div class="row justify-content-center mt-3">
        <?php foreach($models as $model) { ?>
            <div class="col-6 col-md-4 col-lg-3 col-xxl-2 m-3">
                <div class="card" style="width: 14rem;">
                    <img class="card-img-left" src="<?=Url::to('@web/books_img/' . $model->img)?>" alt="Okładka książki">
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

