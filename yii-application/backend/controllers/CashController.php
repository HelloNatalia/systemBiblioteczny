<?php

namespace backend\controllers;

use backend\models\Borrow;
use backend\models\Prices;
use backend\models\Books;
use backend\models\Days;
use yii\db\Expression;
use yii;
use yii\DateTime;
use backend\models\Autors;
use backend\models\Returns;
use backend\models\SearchBorrow;

class CashController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $query = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')]);
        $price = Prices::find()->one();
        $searchModel = new SearchBorrow();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/cash']);
        } 

        if(Yii::$app->request->get('sort')) $sort = Yii::$app->request->get('sort');
        else $sort = '';

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search($query, $sort)[0];
        $pages = $searchModel->search($query, $sort)[1];


        return $this->render('index', [
            'models' => $models,
            'price' => $price,
            'pages' => $pages,
            'searchModel' => $searchModel,
            'totalincome' => $this->moneyForBooks($models, $price),
        ]);
    }

    public function actionPay($id)
    {
        $qdays = new Days();

        $model = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->where(['borrow.id' => $id])->one();
        $author = Autors::find()->where(['id'=>$model->book->autor_id])->one();
        
        $price = Prices::find()->one();
        $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
        $datetime = new \DateTime($datetime ->format('Y-m-d 23:59:00')); 
        $returndate = new \DateTime($model->return_date);
        $days = (date_diff($datetime, $returndate));

        $days = $days->format('%a'); 
        $pricetopay = $days * $price->priceperday;

        if($qdays->load(Yii::$app->request->post())) {
            return $this->redirect(['pay-extend', 'id' => $id, 'days' => $days, 'price' => $pricetopay, 'qdays' => $qdays->quantity]);
        }

        return $this->render('pay', [
            'model' => $model,
            'days' => $days,
            'pricetopay' => $pricetopay,
            'author' => $author,
            'qdays' => $qdays,
        ]);
    }

    public function actionPayEnd($id, $days, $price)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
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

        if($returns->save(false)) {
            if($borrow->save(false) && $stock->save(false)) {
                return $this->redirect(['index']);
            }
        }
    }

    public function actionPayExtend($id, $days, $price, $qdays)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $dbnow = $now->format('Y-m-d H:i:s');
        $new_date = new \DateTime('now', new \DateTimeZone('UTC'));

        $borrow->return_date = $borrow->modifyDate($new_date, $qdays);
        $borrow->extend_quantity += 1;

        $returns = new Returns();
        $returns->borrow_id = $id;
        $returns->days = $days;
        $returns->price = $price;
        $returns->returned_date = $dbnow;
        $returns->extended = 1;

        if($returns->save(false)) {
            if($borrow->save(false)) {
                return $this->redirect(['index']);
            }
        }
    }

    private function moneyForBooks($models, $price)
    {
        $totalincome = 0;

        foreach($models as $model) {

            $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
            $datetime = new \DateTime($datetime ->format('Y-m-d 23:59:00')); 
            $returndate = new \DateTime($model->return_date);
            $days = (date_diff($datetime, $returndate));
            $days = $days->format('%a'); 
            $pricetopay = $days * $price->priceperday;

            $totalincome += $pricetopay;
        }
        return $totalincome;
    }

}
