<?php
use backend\models\Books;
use yii\helpers\Url;
use yii\helpers\Html;

$author = Books::find()->leftJoin('autors', 'autors.id = books.autor_id')->where('autor_id = ' . $id)->one();

echo $this->render('_submenubook')?>

<h3>Books written by <?= $author->autor->name?> <?= $author->autor->surname?></h3>

<?php foreach($models as $model) { ?>

<div class="book">
    <a href="<?=Url::toRoute(['/books/book', 'id' => $model->id])?>">
        <?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 150px;']) ?>
    </a>
    <div class="details">
        <p><?=$model->title?></p>
    </div>
    <br><br>
</div>

<?php } ?>


