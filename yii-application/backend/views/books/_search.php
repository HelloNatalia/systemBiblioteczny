<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Autors;


$names = Autors::find()
            ->select(['surname'])
            ->indexBy('id')
            ->column();

?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-inline']])?>


<?= Html::submitButton('filter')?>
 <?= Html::a('A-Z', ['index', 'order' => 'asc'])?>
 <?= Html::a('Z-A', ['index', 'order' => 'desc'])?>

<?php ActiveForm::end()?>