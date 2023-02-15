<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use backend\models\Books;
use backend\models\SearchBooks;
use backend\models\SearchAutors;
use backend\models\Autors;
use backend\models\Categories;


class BooksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Books::find()->orderBy(['title' => SORT_ASC])->leftJoin('autors', 'autors.id=books.autor_id');
        $searchModel = new SearchBooks();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/books']);
        } 

        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];

        $booksData = $this->getBooksList();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'booksData' => $booksData,
        ]);

    }

    public function actionCreate($id)
    {
        $books = new Books();
        $autors = new Autors();
        $categories = new Categories();

        if($autors->load(Yii::$app->request->post()))
        {   
            $ifexists = $this->ifAuthorExists($autors);
            // Autors::find()->where(['like', 'name', $autors->name, false])->andWhere(['like', 'surname', $autors->surname, false])->andWhere(['like', 'country', $autors->country, false])->one();

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

        if($id != ""){
            if($one = Autors::find()->where(['id' => $id])->one()) {
                $autors->name = $one->name;
                $autors->surname = $one->surname;
                $autors->country = $one->country;
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
            $ifexists = $this->ifAuthorExists($autors);
            // Autors::find()->where(['like', 'name', $autors->name, false])->andWhere(['like', 'surname', $autors->surname, false])->andWhere(['like', 'country', $autors->country, false])->one();

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

    public function actionAuthors()
    {
        $query = Autors::find();
        $searchModel = new SearchAutors();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['authors']);
        } 

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query)[0];
        $pages = $searchModel->search($query)[1];

        $authorsData = $this->getAuthorsList();

        return $this->render('authors', [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'authorsData' => $authorsData,
        ]);
    }

    public function actionAuthor($id)
    {
        $query = Books::find()->where('autor_id = ' . $id);
        $searchModel = new SearchBooks();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['author', 'id' => $id]);
        }
        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, '')[0]; 
        $pages = $searchModel->search($query, '')[1];

        return $this->render('author', [
            'models' => $models,
            'id' => $id,
            'searchModel' => $searchModel,
            'pages' => $pages,
        ]);
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

    private function ifAuthorExists($model)
    {   
        return Autors::find()
                    ->where(['like', 'name', $model->name, false])
                    ->andWhere(['like', 'surname', $model->surname, false])
                    ->andWhere(['like', 'country', $model->country, false])
                    ->one();
    }

    private function getBooksList()
    {
        $models = Books::find()->leftJoin('autors', 'books.autor_id = autors.id')->orderBy(['title' => SORT_ASC])->all();
        $booksData = [];
        foreach($models as $model){
            $booksData[$model->id] = $model->id . ". \"" . $model->title . "\" " . $model->autor->name . " " . $model->autor->surname;
        }
        return $booksData;
    }

    private function getAuthorsList()
    {
        $models = Autors::find()->all();
        $authorsData = [];
        foreach($models as $model) {
            $authorsData[$model->id] = $model->name . " " . $model->surname;
        }
        return $authorsData;
    }

}
