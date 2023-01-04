<?php

namespace backend\controllers;

use backend\models\Books;

class BooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Books::find()->leftJoin('autors', 'autors.id=books.autor_id')->all();

        return $this->render('index', ['models' => $models]);
    }

}
