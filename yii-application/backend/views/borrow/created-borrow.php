<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>


<h2>Podsumowanie</h2><br><br>

<p><b>Książka:</b></p>
<?= Html::img(Url::to('@web/books_img/' . $model->book->img), ['style' => 'width: 150px;']) ?>
<p>ID: <?=$model->book->id?></p>
<p><?=$model->book->title?></p>
<p><?=$author->name?> <?=$author->surname?></p><br><br>

<p><b>Czytelnik:</b></p>
<p>ID: <?=$model->reader->id?></p>
<p><?=$model->reader->name?> <?=$model->reader->surname?></p>

<a href="<?=Url::to(['index'])?>"><button>Wróć do listy wypożyczeń</button></a>