<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Books;
use yii\helpers\ArrayHelper;
use backend\models\Autors;
use backend\models\Categories;

$authorsList = new Autors();

$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($searchModel, 'id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Books::find()->select('id')->orderBy(['id' => SORT_ASC])->all(), 'id', 'id'),
    'options' => ['placeholder' => 'Wyszukaj ID książki...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'title')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Books::find()->select('title')->orderBy(['title' => SORT_ASC])->all(), 'title', 'title'),
    'options' => ['placeholder' => 'Wyszukaj tytuł książki...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'autor_id')->widget(Select2::classname(), [
    'data' => $authorsList->getAuthorsList(),
    'options' => ['placeholder' => 'Wyszukaj autora...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'publ_year')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Books::find()->select('publ_year')->orderBy(['publ_year' => SORT_ASC])->distinct()->all(), 'publ_year', 'publ_year'),
    'options' => ['placeholder' => 'Wyszukaj rok wydania...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>
<?= $form->field($searchModel, 'category_id')->widget(Select2::classname(), [
    'data' => ArrayHelper::map(Categories::find()->all(), 'id', 'category_name'),
    'options' => ['placeholder' => 'Wyszukaj kategorię...'],
    'pluginOptions' => [
        'allowClear' => true,
        'width' => '500px'
    ],
])->label("") ?>

<?= Html::submitButton('Szukaj')?>
<?= Html::a('Pokaż wszystko', ['status', 'clear' => 1], ['class' => 'btn btn-primary btn-sm']) ?>
<p>
    <b>Ilość w bibliotece: </b>
    <?= Html::a('&#129169;', ['status', 'sort' => 'asc'], ['class' => 'btn btn-primary btn-sm']) ?> 
    <?= Html::a('&#129171;', ['status', 'sort' => 'desc'], ['class' => 'btn btn-primary btn-sm']) ?>
</p>


<?php ActiveForm::end()?>