<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Books;
use backend\models\Reader;
?>

<?= $this->render('_search_r', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData, 'page' => 'paid'])?>

<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <th style="border: 1px solid; padding: 15px;">ID wypożyczenia</th>
        <th style="border: 1px solid; padding: 15px;">
            Data wypożyczenia <?= Html::a('&#129169;', ['paid', 'sort' => 'd1asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd1desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">
            Planowana data zwrotu <?= Html::a('&#129169;', ['paid', 'sort' => 'd2asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd2desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">
            Data zapłaty<?= Html::a('&#129169;', ['paid', 'sort' => 'd3asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['paid', 'sort' => 'd3desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">Ilość przetrzymanych dni</th>
        <th style="border: 1px solid; padding: 15px;">Zapłacono</th>
        <th style="border: 1px solid; padding: 15px;">Czytelnik</th>
        <th style="border: 1px solid; padding: 15px;">Książka</th>
        <th style="border: 1px solid; padding: 15px;">Zwrócono</th>
        <th style="border: 1px solid; padding: 15px;">Przedłużono</th>
    </tr>
    <?php foreach($models as $model) { 
        $book = Books::find()->where(['id' => $model->borrow->book_id])->one();
        $reader = Reader::find()->where(['id' => $model->borrow->reader_id])->one(); ?>
        <tr>
            <td style="border: 1px solid; padding: 15px;"><?=$model->borrow->id?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->borrow->date_time?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->borrow->return_date?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->returned_date?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->days?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->price?> zł</td>
            <td style="border: 1px solid; padding: 15px;"><?=$reader->id?> <?=$reader->name?> <?=$reader->surname?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$book->id?> <?=$book->title?></td>
            <?php if($model->extended == 1) { ?>
                <td style="border: 1px solid; padding: 15px;">NIE</td>
                <td style="border: 1px solid; padding: 15px;">TAK</td>
            <?php } else { ?>
                <td style="border: 1px solid; padding: 15px;">TAK</td>
                <td style="border: 1px solid; padding: 15px;">NIE</td>
            <?php } ?>
        </tr>
    <?php } ?>
    
</table>

<?php echo LinkPager::widget([
'pagination' => $pages,
]); ?>