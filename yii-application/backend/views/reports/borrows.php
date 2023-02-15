<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<?= $this->render('_search', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData, 'page' => 'borrows', 'between' => true])?>


<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <th style="border: 1px solid; padding: 15px;">ID wypożyczenia</th>
        <th style="border: 1px solid; padding: 15px;">
            Data wypożyczenia <?= Html::a('&#129169;', ['borrows', 'sort' => 'd1asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['borrows', 'sort' => 'd1desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">
            Data zwrotu <?= Html::a('&#129169;', ['borrows', 'sort' => 'd2asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['borrows', 'sort' => 'd2desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">Czytelnik</th>
        <th style="border: 1px solid; padding: 15px;">Książka</th>
        <th style="border: 1px solid; padding: 15px;">
            Zwrócone<?= Html::a('&#129169;', ['borrows', 'sort' => 'd3asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['borrows', 'sort' => 'd3desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
    </tr>
    <?php foreach($models as $model) { ?>
        <tr>
            <td style="border: 1px solid; padding: 15px;"><?=$model->id?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->date_time?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->return_date?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->book->id?> <?=$model->book->title?></td>
            <?php if($model->returned == 1) { ?>
                <td style="border: 1px solid; padding: 15px;">TAK<br><?=$model->returned_date?></td>
            <?php } else { ?>
                <td style="border: 1px solid; padding: 15px;">NIE</td>
            <?php } ?>
        </tr>
    <?php } ?>
    
</table>

<?php echo LinkPager::widget([
'pagination' => $pages,
]); ?>