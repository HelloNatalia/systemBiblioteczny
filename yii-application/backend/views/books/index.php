<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
?>


<?php foreach($models as $model) { ?>

    <div class="book">
        <a href="<?=Url::toRoute(['/books/book', 'id' => $model->id])?>">
            <?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 150px;']) ?>
        </a>
        <div class="details">
            <h3><?=$model->title?></h3>
            <p><?=$model->autor->name?> <?=$model->autor->surname?></p>
        </div>
        <div class="status">
            <?php if($model->quantity > 0){ ?>
                <p id="Qmorethan0">Zostało: <?=$model->quantity?> sztuk</p>   
            <?php } elseif($model->quantity == 0) { ?>
                <p id="Qzero">Zostało: <?=$model->quantity?> sztuk</p>
            <?php } else { ?>
                <p id="Qlessthan0">Brak w bibliotece</p>
            <?php } ?>
        </div>
        <div class="buttons">
            <button>Show details</button>
            <button>Edit</button>
            <button>Delete</button>
        </div>
        <br><br>
    </div>

<?php } ?>

