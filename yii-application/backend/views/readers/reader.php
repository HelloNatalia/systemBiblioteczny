<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\models\Autors;
use yii\DateTime;
use yii\widgets\LinkPager;

?>

<h3><?=$model->name?> <?=$model->surname?></h3><br>


<a href="<?=Url::to(['update', 'id' => $model->id])?>"><button>Update</button></a>
<a href="<?=Url::to(['delete-view', 'id' => $model->id])?>"><button>Delete</button></a>
<a href="<?=Url::to(['borrow/create', 'id' => '', 'reader' => $model->id])?>"><button>Wypożycz</button></a>


<p><b>ID: </b><?=$model->id?></p>
<p><b>PESEL: </b><?=$model->PESEL?></p>
<p><b>Nr tel: </b><?=$model->tel_number?></p>
<p><b>E-mail: </b><?=$model->email?></p>
<p><b>Rok urodzenia: </b><?=$model->birth_date?></p>

<br><br>

<p><b>Adres:</b></p>
<p><?=$model->address->street?> <?=$model->address->home?><?php if($model->address->number) echo '/' . $model->address->number; ?></p>
<p><?=$model->address->postal_code?> <?=$model->address->city?> <?=$model->address->country?></p><br><br>


<p><b>Wypożyczone książki: </b></p>
<?= $this->render('_search_r', ['searchModel' => $searchModel, 'id' => $model->id])?><br>

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
    $return_date = $return_date->format('Y-m-d');

    ?>
    <div class="book">
        <a href="<?=Url::to(['books/book', 'id' => $book->book->id])?>">
            <?= Html::img(Url::to('@web/books_img/' . $book->book->img), ['style' => 'width: 150px;']) ?>
        </a>
        <div class="details">
            <h3><?=$book->book->title?></h3>
            <p><?=$author->name?> <?=$author->surname?></p>
        </div>
        <p><?=$borrow_date?> - <?=$return_date?></p>

        <?php if($after_date) { ?>
            <p><b>Po terminie: <?=$left?> dni</b></p>
            <a href="<?=Url::to(['cash/pay', 'id' => $book->id])?>"><button>Rozlicz</button></a>
        <?php } else { ?>
            <p><b>Zostało: <?=$days?> dni</b></p>
            <?php if($book->extend_quantity >= 2) { ?>
                <button disabled="disabled">Przedłuż</button>
                <small>Nie można już przedłużyć</small>
            <?php } else if ($left > 14) { ?>
                <button disabled="disabled">Przedłuż</button>
                <small>Możliwość przedłużenia za <?=$left?> dni</small>
            <?php } else { ?>
                <a href="<?=Url::to(['borrow/extend-days', 'id' => $book->id])?>"><button>Przedłuż</button></a>
            <?php } ?>
            <a href="<?=Url::to(['borrow/end', 'id' => $book->id, 'days' => 0, 'price' => 0])?>"><button>Zakończ</button></a>
        <?php } ?>
        <br><br>
    </div><br>
<?php } ?>


<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>

