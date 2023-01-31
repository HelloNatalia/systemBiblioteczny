<?php

use yii\helpers\Url;

?>

<h3>Czy na pewno usunąć tego czytelnika?</h3>

<p><?=$model->name?> <?=$model->surname?></p>
<p><b>ID: </b><?=$model->id?></p>
<p><b>PESEL: </b><?=$model->PESEL?></p>


<a href="<?=Url::to(['delete', 'id' => $model->id])?>"><button>TAK, chcę usunąć</button></a>
<a href="<?=Url::to(['index'])?>"><button>NIE, wróć do strony czytelnika</button></a>
