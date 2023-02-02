<?php
/** @var yii\web\View $this */

use yii\helpers\Url;
use yii\DateTime;
use yii\helpers\Html;
use yii\widgets\LinkPager;

$totalincome = 0;

foreach($models as $model) {

    $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
    $returndate = new \DateTime($model->return_date);
    $days = (date_diff($datetime, $returndate));
    $days = $days->format('%a'); 
    $pricetopay = $days * $price->priceperday;

    $totalincome += $pricetopay;
}

?>


<h1 style="font-size: 150px;"><?=$totalincome?> zł</h1>


<h2>Należności: </h2><br><br>

<?= $this->render('_search', ['searchModel' => $searchModel])?><br>

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
            <th style="border: 1px solid; padding: 15px;">Dni po terminie</th>
            <th style="border: 1px solid; padding: 15px;">Do zapłaty</th>
            <th style="border: 1px solid; padding: 15px;"></th>
        </tr>
        <?php foreach($models as $model) {

            $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
            $returndate = new \DateTime($model->return_date);
            $days = (date_diff($datetime, $returndate));
            $days = $days->format('%a'); 
            $pricetopay = $days * $price->priceperday;
            ?>
                <tr>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->id?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->date_time?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->return_date?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$model->book->id?> <?=$model->book->title?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$days?></td>
                    <td style="border: 1px solid; padding: 15px;"><?=$pricetopay?> zł</td>
                    <td style="border: 1px solid; padding: 15px;">
                        <a href="<?=Url::to(['pay', 'id' => $model->id])?>"><button>Rozlicz</button></a>
                    </td>
                </tr>
        <?php } ?>
        
    </table>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>