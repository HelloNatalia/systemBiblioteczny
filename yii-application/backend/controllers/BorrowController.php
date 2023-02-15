<?php

namespace backend\controllers;

use Yii;
use DateTime;
use backend\models\Borrow;
use backend\models\Books;
use backend\models\Reader;
use backend\models\Autors;
use backend\models\Days;
use backend\models\SearchBorrow;
use backend\models\Returns;

class BorrowController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0]);
        $searchModel = new SearchBorrow();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/borrow']);
        } 

        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];

        $borrowsData = $this->getBorrowsList();

        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'borrowsData' => $borrowsData,
        ]);
    }

    public function actionExtendDays($id)
    {
        $days = new Days();

        if($days->load(Yii::$app->request->post())){
            return $this->redirect(['extend', 'id' => $id, 'days' => $days->quantity]);
        }

        return $this->render('extend-days', ['borrow_id' => $id, 'days' => $days]);
    }

    public function actionExtend($id, $days)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $return_date = new DateTime($borrow->return_date);
        $borrow->return_date = $borrow->modifyDate($return_date, $days);
        $borrow->extend_quantity += 1;

        if($borrow->save(false)) {
            return $this->redirect(['index']);
        }   
    }

    public function actionEnd($id, $days, $price)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $now = new DateTime('now', new \DateTimeZone('UTC'));
        $dbnow = $now->format('Y-m-d H:i:s');

        $borrow->returned_date = $dbnow;
        $borrow->returned = 1;

        $returns = new Returns();
        $returns->borrow_id = $id;
        $returns->days = $days;
        $returns->price = $price;
        $returns->returned_date = $dbnow;
        $returns->extended = 0;

        $stock = Books::find()->where(['id' => $borrow->book_id])->one();
        $stock->quantity += 1;

        if($days == 0 && $price == 0) $destination = 'index';
        else $destination = "cash/index";

        if($returns->save(false)) {
            if($borrow->save(false) && $stock->save(false)) {
                return $this->redirect([$destination]);
            }
        }
    }

    public function actionCreate($id, $reader)
    {
        $borrow = new Borrow();
        $days = new Days();

        if($id != ''){
            if(Books::find()->andWhere(['id' => $id])->andWhere(['>', 'quantity', 0])->one()) $borrow->book_id = $id; 
        } else if ($reader != ''){
            if(Borrow::find()->where(['id' => $reader])->one()) $borrow->reader_id = $reader;
        }  

        $books = new Books();
        $b_items = $books->booksArray();
        $reader = new Reader();
        $r_items = $reader->readersArray();

        $return_array = [
            'borrow' => $borrow,
            'info' => '', 
            'b_items' => $b_items, 
            'r_items' => $r_items,
            'days' => $days,
        ];
        
        if($borrow->load(Yii::$app->request->post()) && $days->load(Yii::$app->request->post())) {

            if(count(Borrow::find()->andWhere(['reader_id' => $borrow->reader_id])->andWhere(['returned' => 0])->all()) >= 5) {
                $return_array['info'] = 'Czytelnik ma już 5 wypożyczonych książek.';
                return $this->render('create', $return_array);
            }
            $now = new DateTime('now', new \DateTimeZone('UTC'));
            $dbnow = $now->format('Y-m-d H:i:s');

            $borrow->date_time = $dbnow;
            $borrow->return_date = $borrow->modifyDate($now, $days->quantity);
            $borrow->returned = 0;
            $borrow->extend_quantity = 0;

            if($borrow->save(false)) {
                return $this->redirect(['created-borrow', 'id' => $borrow->id]);
            }
        }
        return $this->render('create', $return_array);
    }

    public function actionCreatedBorrow($id)
    {
        $model = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->where(['borrow.id' => $id])->one();
        $author = Autors::find()->where(['id' => $model->book->autor_id])->one();

        $stock = Books::find()->where(['id' => $model->book->id])->one();
        $stock->quantity -= 1;
        
        if($stock->save(false)) {
            return $this->render('created-borrow', ['model' => $model, 'author' => $author]);
        }
    }

    public function getBorrowsList()
    {
        $models = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->where(['returned' => 0])->all();
        $borrow = new Borrow();
        return $borrow->get2Lists($models);
    }

}
