<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Autors;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Url;


?>

<?= Html::beginForm([Url::to('index')], 'get')?>

<?= Html::input('text', 'title', '', ['placeholder' => 'Search for title'])?>
<?= Html::submitButton('filter/clear')?>
 <?php // Html::a('A-Z', ['index', 'order' => 'asc'])?>
 <?php // Html::a('Z-A', ['index', 'order' => 'desc'])?>

<?= Html::endForm() ?>
