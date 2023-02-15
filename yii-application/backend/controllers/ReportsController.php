<?php

namespace backend\controllers;

use Yii;
use backend\models\Borrow;
use backend\models\Books;
use backend\models\Returns;
use backend\models\SearchBorrow;
use backend\models\SearchReturns;
use backend\models\SearchBooks;

class ReportsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionBorrows()
    {
        $query = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id');
        $searchModel = new SearchBorrow();
        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/reports/borrows']);
        } 
        $items = $this->renderAll($query, $searchModel);
        return $this->render('borrows', $items);
    }

    public function actionReturns()
    {
        $query = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->where(['borrow.returned' => 1]);
        $searchModel = new SearchBorrow();
        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/reports/returns']);
        } 
        $items = $this->renderAll($query, $searchModel);
        return $this->render('returns', $items);
    }

    public function actionExtensions()
    {
        $query = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['borrow.returned' => 0])->andWhere(['>', 'extend_quantity', 0]);
        $searchModel = new SearchBorrow();
        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/reports/extensions']);
        } 
        $items = $this->renderAll($query, $searchModel);
        return $this->render('extensions', $items);
    }

    public function actionPaid()
    {
        $query = Returns::find()->leftJoin('borrow', 'borrow.id = returns.borrow_id')->where(['>', 'returns.days', 0]);
        $searchModel = new SearchReturns();
        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/reports/paid']);
        } 
        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];

        $borrowsData = $this->getReturnsList();
        return $this->render('paid', [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'borrowsData' => $borrowsData,
        ]);
    }

    public function actionStatus()
    {
        $query = Books::find()->leftJoin('categories', 'categories.id = books.category_id')->leftJoin('autors', 'autors.id = books.autor_id')->where(['>', 'quantity', 0]);
        $searchModel = new SearchBooks;
        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/reports/status']);
        }
        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';
        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];

        return $this->render('status', [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
        ]);
    }

    public function getBorrowsList()
    {
        $models = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->all();
        $borrow = new Borrow();
        return $borrow->get2Lists($models);
    }

    public function getReturnsList()
    {
        $models = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->all();
        $borrowsData = [];
        foreach($models as $model) {
            $borrowsData[$model->id] = "Nr " . $model->id . " - " . $model->reader->id . "-" . $model->reader->name . " " . $model->reader->surname . " - \"" . $model->book->title;
        }
        return $borrowsData;
    }

    public function renderAll($query, $searchModel)
    {
        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];

        $borrowsData = $this->getBorrowsList();

        return [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'borrowsData' => $borrowsData,
        ];
    }

}
