<?php

namespace backend\controllers;

use backend\models\Books;
use backend\models\Autors;
use backend\models\Categories;

class BooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Books::find()->leftJoin('autors', 'autors.id=books.autor_id')->all();

        return $this->render('index', ['models' => $models]);
    }

    public function actionCreate()
    {
        $books = new Books();
        $autors = new Autors();
        $categories = new Categories();


        return $this->render('create', [
            'books' => $books,
            'autors' => $autors,
            'categories' => $categories
        ]);
    }

}
