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
    $borrow_date = new \DateTime($book->date_time);
    $return_date = new \DateTime($book->return_date);
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
        <p><b>Zostało: <?=$days?> dni</b></p>
    </div><br>
<?php } ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>