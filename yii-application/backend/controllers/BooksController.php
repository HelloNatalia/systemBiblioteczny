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
        $models = Books::find()->orderBy(['title' => SORT_ASC])->leftJoin('autors', 'autors.id=books.autor_id')->all();
        if(Yii::$app->request->get('order') === 'desc')
        {
            $models = Books::find()->leftJoin('autors', 'autors.id=books.autor_id')->orderBy(['title' => SORT_DESC])->all();
        }

        

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
                $this->getBookData($books, true);
            }

            elseif($books->load(Yii::$app->request->post()) && $autors->save(false))
            {
                $books->autor_id = $autors->id;
                $this->getBookData($books, true);
            }
        }

        return $this->render('create', [
            'books' => $books,
            'autors' => $autors,
            'categories' => $categories
        ]);
    }

    public function actionBook($id)
    {
        $model = Books::find()->leftJoin('autors', 'autors.id=books.autor_id')->leftJoin('categories', 'categories.id=books.category_id')->where(['books.id' => $id])->one();
        return $this->render('book', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $books = Books::findOne(['id' => $id]);
        $autors = Autors::findOne(['id' => $books->autor_id]);

        if($autors->load(Yii::$app->request->post()))
        {   
            $ifexists = Autors::find()->where(['like', 'name', $autors->name, false])->andWhere(['like', 'surname', $autors->surname, false])->andWhere(['like', 'country', $autors->country, false])->one();

            if($ifexists && $books->load(Yii::$app->request->post()))
            {
                $books->autor_id = (int) $ifexists->id;
                $this->getBookData($books, false);
            }

            elseif($books->load(Yii::$app->request->post()) && $autors->save(false))
            {
                $books->autor_id = $autors->id;
                $this->getBookData($books, false);
            }
        }

        return $this->render('update', ['books' => $books, 'autors' => $autors]);
    }

    public function actionDeleteView($id)
    {
        $model = Books::find()->leftJoin('autors', 'autors.id=books.autor_id')->leftJoin('categories', 'categories.id=books.category_id')->where(['books.id' => $id])->one();

        return $this->render('delete-view', ['model' => $model]);
        
    }

    public function actionDelete($id)
    {   
        if($model = Books::findOne(['id' => $id]))
        {
            if($model->delete())
            {
                return $this->redirect(['index']);
            }
        }
        
    }



    private function getBookData($books, $bool)
    {
        if($bool)
        {
            $image = UploadedFile::getInstance($books, 'img');
            $image->saveAs('books_img/' . $image->baseName . '.' . $image->extension);
            $books->img = $image->baseName . '.' . $image->extension;
        }
        

        if($books->save(false)) {
            return $this->redirect(['book', 'id' => $books->id]);
        }
    }

}
