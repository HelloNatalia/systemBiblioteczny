<?php

?>

<h3><?=$model->name?> <?=$model->surname?></h3>

<p><b>ID: </b><?=$model->id?></p>
<p><b>PESEL: </b><?=$model->PESEL?></p>
<p><b>Nr tel: </b><?=$model->tel_number?></p>
<p><b>E-mail: </b><?=$model->email?></p>
<p><b>Rok urodzenia: </b><?=$model->birth_date?></p>

<br><br>

<p><b>Adres:</b></p>
<p><?=$model->address->street?> <?=$model->address->home?>/<?=$model->address->number?></p>
<p><?=$model->address->postal_code?> <?=$model->address->city?> <?=$model->address->country?></p>