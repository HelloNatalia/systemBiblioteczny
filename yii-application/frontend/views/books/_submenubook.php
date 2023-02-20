<?php

use yii\widgets\Menu;
use yii\helpers\Url;
use yii\helpers\Html;

if(Html::encode($this->title) == 'Książki') {
    $title2 = 'Autorzy';
    $url1 = 'index';
    $url2 = 'authors';
    ?>
    
    <p class="fs-4">
        <button class="btn btn-dark me-2"><?=Html::encode($this->title)?></button>
        <span class="fs-5">
            <a href="<?=Url::toRoute(['/books/' . $url2])?>" class="text-decoration-none text-reset">
                <button class="btn btn-outline-dark btn-sm me-2"><?=$title2?></button>
            </a>
        </span>
    </p>
<?php } else {
    $title2 = "Książki";
    $url2 = 'index';
    $url1 = 'authors';
    ?>
    <p class="fs-4">
        <button class="btn btn-outline-dark btn-sm me-2">
            <a href="<?=Url::toRoute(['/books/' . $url2])?>" class="text-decoration-none text-reset">
                <?=$title2?>
            </a>
        </button>
        <span class="fs-5">
            <button class="btn btn-dark"><?=Html::encode($this->title)?></button>
        </span>
    </p>
<?php } ?> 

