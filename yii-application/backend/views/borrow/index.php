<?php

use yii\helpers\Url;
use yii\DateTime;

?>

<h2>Wypożyczenia: </h2><br><br>



    <table style="border: 1px solid;">
        <tr style="border: 1px solid;">
            <th style="border: 1px solid; padding: 15px;">ID wypożyczenia</th>
            <th style="border: 1px solid; padding: 15px;">Data wypożyczenia</th>
            <th style="border: 1px solid; padding: 15px;">Data zwrotu</th>
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
                            <a href="<?=Url::to(['extend', 'id' => $model->id])?>"><button>Przedłuż</button></a>
                            <a href="<?=Url::to(['end', 'id' => $model->id])?>"><button>Zakończ</button></a>
                        </td>
                    <?php } ?>
                    
                </tr>
        <?php } ?>
        
    </table>

