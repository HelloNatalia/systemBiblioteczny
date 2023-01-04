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
            if($books->load(Yii::$app->request->post()) && $autors->save(false))
            {
                
                // $isValid = $books->validate();
                // $isValid = $autors->validate() && $isValid;
                // $isValid = $categories->validate() && $isValid;
                $books->autor_id = $autors->id;

                $image = UploadedFile::getInstance($books, 'img');
                $image->saveAs('books_img/' . $image->baseName . '.' . $image->extension);

                $books->img = $image->baseName . '.' . $image->extension;
                print($books->img);
                echo $books->img;

                // if($isValid) {
                //     $books->save(false);
                //     $autors->save(false);
                //     $categories->save(false);
                //     return $this->redirect(['book', 'id' => $books->id]);
                // }
                if($books->save(false) && $autors->save(false)) {
                    
                    return $this->redirect(['book', 'id' => $books->id]);
                }
                
            }
        }

        

        return $this->render('create', [
            'books' => $books,
            'autors' => $autors,
            'categories' => $categories
        ]);
    }

}
