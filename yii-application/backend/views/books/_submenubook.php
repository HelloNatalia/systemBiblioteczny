<?php

use yii\widgets\Menu;

echo Menu::widget([
    'items' => [
        ['label' => 'Collection', 'url' => ['books/index']],
        ['label' => 'Authors', 'url' => ['books/authors']],
    ],
]);