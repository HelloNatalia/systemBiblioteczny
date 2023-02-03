<?php

use yii\helpers\Url;
use yii\DateTime;
use yii\helpers\Html;
use yii\widgets\LinkPager;

?>

<h2>Wypożyczenia: </h2><br>

<?= $this->render('_search', ['searchModel' => $searchModel])?><br>

<a href="<?=Url::to(['create', 'id' => '', 'reader' => ''])?>"><button>Dodaj</button></a>
<br><br>

    <table style="border: 1px solid;">
        <tr style="border: 1px solid;">
            <th style="border: 1px solid; padding: 15px;">ID wypożyczenia</th>
            <th style="border: 1px solid; padding: 15px;">
                Data wypożyczenia <?= Html::a('&#129169;', ['index', 'sort' => 'd1asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd1desc'], ['class' => 'btn btn-primary btn-sm']) ?>
            </th>
            <th style="border: 1px solid; padding: 15px;">
                Data zwrotu <?= Html::a('&#129169;', ['index', 'sort' => 'd2asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                    <?= Html::a('&#129171;', ['index', 'sort' => 'd2desc'], ['class' => 'btn btn-primary btn-sm']) ?>
            </th>
            <th style="border: 1px solid; padding: 15px;">Czytelnik</th>
            <th style="border: 1px solid; padding: 15px;">Książka</th>
            <th style="border: 1px solid; padding: 15px;"></th>
        </tr>
        <?php foreach($models as $model) { 
            $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
            $returndate = new \DateTime($model->return_date); ?>
            <?php if($returndate < $datetime) { ?>
                <tr style="background-color: red;">
            <?php } else { ?>
                <tr>
            <?php } ?>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->id?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->date_time?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->return_date?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->book->id?> <?=$model->book->title?></td>
                    <?php if($returndate < $datetime) { ?>
                        <td style="border: 1px solid; padding: 15px;">
                            <a href="<?=Url::to(['cash/pay', 'id' => $model->id])?>"><button>Rozlicz</button></a>
                        </td>
                    <?php } else { ?>
                        <td style="border: 1px solid; padding: 15px;">
                            <?php if($model->extend_quantity >= 2) { ?>
                                <button disabled="disabled">Przedłuż</button>
                                <small>Nie można już przedłużyć</small>
                            <?php } else if (((date_diff($returndate, $datetime))->format('%a')) > 14) { 
                                $left = (date_diff($returndate, $datetime))->format('%a'); ?>
                                <button disabled="disabled">Przedłuż</button>
                                <small>Możliwość przedłużenia za <?=$left?> dni</small>
                            <?php } else { ?>
                                <a href="<?=Url::to(['extend-days', 'id' => $model->id])?>"><button>Przedłuż</button></a>
                            <?php } ?>
                            <a href="<?=Url::to(['end', 'id' => $model->id, 'days' => 0, 'price' => 0])?>"><button>Zakończ</button></a>
                        </td>
                    <?php } ?>
                    
                </tr>
        <?php } ?>
        
    </table>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>

