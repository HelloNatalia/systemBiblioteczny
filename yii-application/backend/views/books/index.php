<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
// use yii\bootstrap5\Modal;

/** @var yii\web\View $this */
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
                            <p class="card-text">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-4">
                                        <a class="text-decoration-none" href="<?=Url::to(['update', 'id' => $model->id])?>">
                                        <button title="Edytuj" class="btn btn-dark btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </button>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="<?= Url::to(['delete-view', 'id' => $model->id])?>">
                                            <button title="Usuń" class="btn btn-danger btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <?php if($model->quantity > 0) { ?>
                                            <a href="<?= Url::to(['borrow/create', 'id' => $model->id, 'reader' => ''])?>"><button title="Wypożycz" class="btn btn-success btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                                                </svg>
                                            </button></a>
                                        <?php } ?>
                                    </div>
                                </div>
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



