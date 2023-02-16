<?php
use backend\models\Books;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$author = Books::find()->leftJoin('autors', 'autors.id = books.autor_id')->where('autor_id = ' . $id)->one();
?>

<h3>Books written by <?= $author->autor->name?> <?= $author->autor->surname?></h3>

<?= $this->render('_searchtitle_a', ['searchModel' => $searchModel, 'author' => $author, 'id' => $id])?>
<a href="<?=Url::to(['create', 'id' => $id])?>"><button id="new_book">Add new book</button></a>

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

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>


