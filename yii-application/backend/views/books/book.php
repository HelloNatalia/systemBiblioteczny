<?php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Categories;

?>
<a href="<?=Url::to(['update', 'id' => $model->id])?>"><button>Update</button></a>
<?= Html::img(Url::to('@web/books_img/' . $model->img), ['style' => 'width: 200px'])?>

<h2><?=$model->title?></h2>
<p>Autor: <?=$model->autor->name?> <?=$model->autor->surname?></p>
<p>Category: <?=$model->category->category_name?></p> <br>
<p><?=$model->description?></p><br><br>

<p><?=$model->publ_year?></p>