<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use backend\models\Books;

$books = Books::find()->all();

?>

<div class="container">

<?=$this->render('_submenubook')?>
<?=$this->render('_searchauthor', ['searchModel' => $searchModel, 'authorsData' => $authorsData])?>

<table class="table mt-5 table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <td scope="col">L.p.</td>
            <td scope="col">Imię</td>
            <td scope="col">Nazwisko</td>
            <td scope="col">Kraj pochodzenia</td>
            <td scope="col"></td>
        </tr>
    </thead>
    <tbody>
        <?php $i = 0 ?>
        <?php foreach($models as $model) { 
            $i += 1;
            if(Books::find()->where('autor_id = ' . $model->id)->one() != null) { ?>
                
                <tr>
                    <th scope="row">
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/books/author', 'id' => $model->id])?>">
                            <?=$i?>
                        </a>
                    </th>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/books/author', 'id' => $model->id])?>">
                            <?=$model->name?>
                        </a>
                    </td>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/books/author', 'id' => $model->id])?>">
                            <?=$model->surname?>
                        </a>
                    </td>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/books/author', 'id' => $model->id])?>">
                            <?=$model->country?>
                        </a>
                    </td>
                    <td>
                        <?= Html::a('Pokaż', ['author', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
                    </td>
                </tr>

            <?php }
        } ?>
    </tbody>
</table>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>

</div>