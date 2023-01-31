<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
?>
<h2>Czytelnicy</h2>
<br>

<?php foreach ($models as $model) { ?>
<a href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
    <?=$model->name?> <?=$model->surname?> <?=$model->email?> id: <?=$model->id?>
</a><br>
<?php } ?>

