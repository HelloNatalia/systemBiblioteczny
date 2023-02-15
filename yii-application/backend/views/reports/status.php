<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>

<?= $this->render('_search_b', ['searchModel' => $searchModel])?>

<table style="border: 1px solid;">
    <tr style="border: 1px solid;">
        <th style="border: 1px solid; padding: 15px;">ID</th>
        <th style="border: 1px solid; padding: 15px;">Tytuł</th>
        <th style="border: 1px solid; padding: 15px;">Autor</th>
        <th style="border: 1px solid; padding: 15px;">Rok wydania</th>
        <th style="border: 1px solid; padding: 15px;">Kategoria</th>
        <th style="border: 1px solid; padding: 15px;">Ilość</th>
    </tr>
    <?php foreach($models as $model) { ?>
        <tr>
            <td style="border: 1px solid; padding: 15px;"><?=$model->id?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->title?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->autor->name?> <?=$model->autor->surname?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->publ_year?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->category->category_name?></td>
            <td style="border: 1px solid; padding: 15px;"><?=$model->quantity?> szt.</td>
        </tr>
    <?php } ?>
    
</table>

<?php echo LinkPager::widget([
'pagination' => $pages,
]); ?>