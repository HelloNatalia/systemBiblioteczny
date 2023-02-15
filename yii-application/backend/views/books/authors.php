<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Books;

$books = Books::find()->all();

echo $this->render('_submenubook');

echo $this->render('_searchauthor', ['searchModel' => $searchModel, 'authorsData' => $authorsData]);

foreach($models as $model) { 
    if(Books::find()->where('autor_id = ' . $model->id)->one() != null) { ?>
    
        <a href="<?=Url::toRoute(['/books/author', 'id' => $model->id])?>"><?=$model->name . " " . $model->surname?></a><br>
    
    <?php }
} ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>