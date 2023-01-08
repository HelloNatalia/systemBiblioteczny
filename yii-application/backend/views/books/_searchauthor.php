<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Autors;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Url;


?>

<?= Html::beginForm([Url::to('authors')], 'get')?>

<?= Html::input('text', 'author', '', ['placeholder' => 'Search for author'])?>
<?= Html::submitButton('filter/clear')?>

<?= Html::endForm() ?>
