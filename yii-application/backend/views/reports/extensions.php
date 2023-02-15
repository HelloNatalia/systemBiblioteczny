<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use backend\models\Returns;
?>

<?= $this->render('_search', ['searchModel' => $searchModel, 'borrowsData' => $borrowsData, 'page' => 'extensions'])?>


<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <th style="border: 1px solid; padding: 15px;">ID wypożyczenia</th>
        <th style="border: 1px solid; padding: 15px;">
            Data wypożyczenia <?= Html::a('&#129169;', ['extensions', 'sort' => 'd1asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['extensions', 'sort' => 'd1desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">
            Nowa data zwrotu <?= Html::a('&#129169;', ['extensions', 'sort' => 'd2asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
                                <?= Html::a('&#129171;', ['extensions', 'sort' => 'd2desc'], ['class' => 'btn btn-primary btn-sm']) ?>
        </th>
        <th style="border: 1px solid; padding: 15px;">Czytelnik</th>
        <th style="border: 1px solid; padding: 15px;">Książka</th>
        <th style="border: 1px solid; padding: 15px;">Po terminie</th>
        <th style="border: 1px solid; padding: 15px;">Należność</th>
        <th style="border: 1px solid; padding: 15px;">Zapłacono dnia</th>
    </tr>
    <?php foreach($models as $model) { ?>
        <tr>
            <td style="border: 1px solid; padding: 15px;"><?=$model->id?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->date_time?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->return_date?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->reader->id?> <?=$model->reader->name?> <?=$model->reader->surname?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->book->id?> <?=$model->book->title?></td>
            <?php if($returnModel = Returns::find()->where(['borrow_id' => $model->id])->one()) { ?>
                <td style="border: 1px solid; padding: 15px;"><?=$returnModel->days?> dni</td>
                <td style="border: 1px solid; padding: 15px;"><?=$returnModel->price?> zł</td>
                <td style="border: 1px solid; padding: 15px;"><?=$returnModel->returned_date?></td>
            <?php } else {?>
                <td style="border: 1px solid; padding: 15px;">-</td>
                <td style="border: 1px solid; padding: 15px;">-</td>
                <td style="border: 1px solid; padding: 15px;">-</td>
            <?php } ?>
            
        </tr>
    <?php } ?>
    
</table>

<?php echo LinkPager::widget([
'pagination' => $pages,
]); ?>