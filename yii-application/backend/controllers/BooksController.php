<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Books;
use backend\models\Autors;
use backend\models\Categories;
use yii\web\UploadedFile;

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

        if($autors->load(Yii::$app->request->post()))
        {   
            $ifexists = Autors::find()->where(['like', 'name', $autors->name, false])->andWhere(['like', 'surname', $autors->surname, false])->andWhere(['like', 'country', $autors->country, false])->one();

            if($ifexists && $books->load(Yii::$app->request->post()))
            {
                $books->autor_id = (int) $ifexists->id;
                $this->getBookData($books);
            }

            elseif($books->load(Yii::$app->request->post()) && $autors->save(false))
            {
                $books->autor_id = $autors->id;
                $this->getBookData($books);
            }
        }

        return $this->render('create', [
            'books' => $books,
            'autors' => $autors,
            'categories' => $categories
        ]);
    }




    private function getBookData($books)
    {
        $image = UploadedFile::getInstance($books, 'img');
        $image->saveAs('books_img/' . $image->baseName . '.' . $image->extension);

        $books->img = $image->baseName . '.' . $image->extension;
        print($books->img);
        echo $books->img;

        if($books->save(false)) {
            
            return $this->redirect(['book', 'id' => $books->id]);
        }
    }

}
