<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Czytelnicy</p>
        </div>
    </div>
    <?= $this->render('_search', ['searchModel' => $searchModel, 'readersData' => $readersData])?>
    <div class="row">
        <div class="col">
            <a href="<?=Url::to(['create'])?>"><button class="btn btn-success btn-md">Dodaj nowego czytelnika</button></a><br>
        </div>
    </div>
    <table class="table mt-5 table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <td scope="col">Nr</td>
                <td scope="col">Imię</td>
                <td scope="col">Nazwisko</td>
                <td scope="col">E-mail</td>
                <td scope="col"></td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0 ?>
            <?php foreach($models as $model) { ?>
                <tr>
                    <th scope="row">
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
                            <?=$model->id?>
                        </a>
                    </th>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
                            <?=$model->name?>
                        </a>
                    </td>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
                            <?=$model->surname?>
                        </a>
                    </td>
                    <td>
                        <a class="text-decoration-none text-reset" href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
                            <?=$model->email?>
                        </a>
                    </td>
                    <td>
                        <?= Html::a('Pokaż', ['reader', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-8 col-md-5 col-lg-2">
            <?php echo LinkPager::widget([
                'pagination' => $pages,
                'pageCssClass' => 'page-link',
            ]); ?>
        </div>
    </div>
    

</div>