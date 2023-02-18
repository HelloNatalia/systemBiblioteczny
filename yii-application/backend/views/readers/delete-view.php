<?php

use yii\helpers\Url;
use backend\models\Borrow;

?>


<div class="container">
    <div class="row">
        <div class="col">
            <p class="display-5 fs-2 mt-4">Czy na pewno chcesz usunąć tego czytelnika?</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12 col-md-6">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Nr</th>
                        <td><?=$model->id?></td>
                    </tr>
                    <tr>
                        <th>Imię i nazwisko</th>
                        <td><?=$model->name?> <?=$model->surname?></td>
                    </tr>
                    <tr>
                        <th>PESEL</th>
                        <td><?=$model->PESEL?></td>
                    </tr>
                    <tr>
                        <th>Nr telefonu</th>
                        <td><?=$model->tel_number?></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?=$model->email?></td>
                    </tr>
                    <tr>
                        <th>Rok urodzenia</th>
                        <td><?=$model->birth_date?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col ms-2">
            <?php if(Borrow::find()->andWhere(['reader_id' => $model->id])->andWhere(['returned' => 0])->one()) { ?>
                <div class="row">
                    <div class="col">
                        <p>Przed usunięciem czytelnika, musi on zwrócić wypożyczone książki.</p>
                    </div>
                </div>
                <button disabled="disabled" class="btn btn-success btn-md me-3 disabled">TAK, chcę usunąć</button></a>
            <?php } else { ?>
                <a href="<?=Url::to(['delete', 'id' => $model->id])?>"><button class="btn btn-success btn-md me-3">TAK, chcę usunąć</button></a>
            <?php } ?>
            <a href="<?=Url::to(['reader', 'id' => $model->id])?>"><button class="btn btn-danger btn-md">NIE, wróć do strony czytelnika</button></a>
        </div>
    </div>
</div>


