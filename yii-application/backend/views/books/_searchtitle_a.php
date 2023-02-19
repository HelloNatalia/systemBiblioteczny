<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Books;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<div class="row">
    <div class="col-12 col-md-7">
        <?= $form->field($searchModel, 'title')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Books::find()->select('title')->where(['autor_id' => $id])->orderBy(['title' => SORT_ASC])->all(), 'title', 'title'),
            'options' => ['placeholder' => 'Wyszukaj tytuł...'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label("") ?>
    </div>
    <div class="col-12 col-md-5 mt-4">
        <?= Html::submitButton('Szukaj', ['class' => 'btn btn-dark btn-md me-2'])?>
        <?= Html::a('Pokaż wszystko', ['author', 'clear' => 1, 'id' => $author->autor->id], ['class' => 'btn btn-dark btn-md']) ?>
    </div>
</div>
<?php ActiveForm::end()?>

