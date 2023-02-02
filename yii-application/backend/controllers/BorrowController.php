<?php

namespace backend\controllers;

use Yii;
use backend\models\Borrow;
use backend\models\Books;
use backend\models\Reader;
use backend\models\Autors;
use backend\models\Days;
use backend\models\SearchBorrow;
use DateTime;
use backend\models\Returns;

class BorrowController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0]);
        $searchModel = new SearchBorrow();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/borrow']);
        } 
        // if(Yii::$app->request->get('d1sort') == 1) $models = $models->orderBy(['date_time' => SORT_ASC]);
        // else if(Yii::$app->request->get('d1sort') == 0 || !Yii::$app->request->get('d1sort')) $models = $models->orderBy(['date_time' => SORT_DESC]);
        // if(Yii::$app->request->get('d2sort') == 1) $models = $models->orderBy(['return_date' => SORT_ASC]);
        // else if(Yii::$app->request->get('d2sort') == 0 || !Yii::$app->request->get('d2sort')) $models = $models->orderBy(['return_date' => SORT_DESC]);
        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($models, $sort);

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
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

        $return_date->modify("+" . $days . " day");
        $return_date = $return_date->format('Y-m-d H:i:s');
        $borrow->return_date = $return_date;
        if($borrow->save(false)) {
            return $this->redirect(['index']);
        }   
    }

    public function actionEnd($id)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $now = new DateTime('now', new \DateTimeZone('UTC'));
        $dbnow = $now->format('Y-m-d H:i:s');

        $borrow->returned_date = $dbnow;
        $borrow->returned = 1;

        $returns = new Returns();
        $returns->borrow_id = $id;
        $returns->days = 0;
        $returns->price = 0;
        $returns->returned_date = $dbnow;

        $stock = Books::find()->where(['id' => $borrow->book_id])->one();
        $stock->quantity += 1;

        if($returns->save(false)) {
            if($borrow->save(false) && $stock->save(false)) {
                return $this->redirect(['index']);
            }
        }
    }

    public function actionCreate($id)
    {
        $borrow = new Borrow();
        $days = new Days();

        if($id != ''){
            if(Books::find()->andWhere(['id' => $id])->andWhere(['>', 'quantity', 0])->one()){
                $borrow->book_id = $id;
            }   
        }

        $b_items = array();
        $books = Books::find()->leftJoin('autors', 'autors.id = books.autor_id')->where(['>', 'quantity', 0])->all();
        foreach($books as $book) {
            $b_items[$book->id] = $book->id . ' - ' . $book->title . ' - ' . $book->autor->name . ' ' . $book->autor->surname . ' - sztuk: ' . $book->quantity;
        }

        $r_items = array();
        $readers = Reader::find()->all();
        foreach($readers as $reader){
            $r_items[$reader->id] = $reader->id . ' - ' . $reader->name . ' ' . $reader->surname . ' - PESEL: ' . $reader->PESEL;
        }

        if($borrow->load(Yii::$app->request->post()) && $days->load(Yii::$app->request->post())) {

            $now = new DateTime('now', new \DateTimeZone('UTC'));
            $dbnow = $now->format('Y-m-d H:i:s');

            $returndate = new DateTime('now', new \DateTimeZone('UTC'));
            $returndate = $returndate->modify("+" . $days->quantity . " day");
            $returndate = $returndate->format('Y-m-d H:i:s');

            $borrow->date_time = $dbnow;
            $borrow->return_date = $returndate;
            $borrow->returned = 0;

            if($borrow->save(false)) {
                return $this->redirect(['created-borrow', 'id' => $borrow->id]);
            }

        }

        return $this->render('create', [
            'borrow' => $borrow, 
            'b_items' => $b_items,
            'r_items' => $r_items,
            'days' => $days,
        ]);
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

}
