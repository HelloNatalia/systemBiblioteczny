<?php
/** @var yii\web\View $this */
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>
<h2>Czytelnicy</h2>
<br>

<?= $this->render('_search', ['searchModel' => $searchModel])?><br>

<a href="<?=Url::to(['create'])?>"><button>Add new reader</button></a><br>

<?php foreach ($models as $model) { ?>
<a href="<?=Url::toRoute(['/readers/reader', 'id' => $model->id])?>">
    <?=$model->name?> <?=$model->surname?> <?=$model->email?> id: <?=$model->id?>
</a><br>
<?php } ?>

<?php echo LinkPager::widget([
    'pagination' => $pages,
]); ?>