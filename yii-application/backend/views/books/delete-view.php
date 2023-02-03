<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<h3>Are you sure, you want to delete this book?</h3>

<p><?=$model->title?></p>
<p><?=$model->autor->name?> <?=$model->autor->surname?></p>
<?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 150px;']) ?>

<p>Category: <?=$model->category->category_name?></p>
<p>Publication year: <?=$model->publ_year?></p>

<a href="<?=Url::to(['delete', 'id' => $model->id])?>"><button>YES, I want to delete</button></a>
<a href="<?=Url::to(['index'])?>"><button>NO, go back to books</button></a>
