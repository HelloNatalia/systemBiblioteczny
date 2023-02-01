<?php

namespace backend\controllers;

use backend\models\Borrow;
use backend\models\Prices;
use backend\models\Books;
use yii\db\Expression;
use yii;
use yii\DateTime;
use backend\models\Autors;
use backend\models\Returns;

class CashController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')])->orderBy(['return_date' => SORT_ASC])->all();
        $price = Prices::find()->one();
        return $this->render('index', ['models' => $models, 'price' => $price]);
    }

    public function actionPay($id)
    {
        $model = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->where(['borrow.id' => $id])->one();
        $author = Autors::find()->where(['id'=>$model->book->autor_id])->one();
        
        $price = Prices::find()->one();
        $datetime = new \DateTime('now', new \DateTimeZone('UTC'));
        $returndate = new \DateTime($model->return_date);
        $days = (date_diff($datetime, $returndate));

        $days = $days->format('%a'); 
        $pricetopay = $days * $price->priceperday;

        return $this->render('pay', [
            'model' => $model,
            'days' => $days,
            'pricetopay' => $pricetopay,
            'author' => $author,
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

    public function actionPayExtend($id, $days, $price)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $now = new \DateTime('now', new \DateTimeZone('UTC'));
        $dbnow = $now->format('Y-m-d H:i:s');

        $new_date = new \DateTime('now', new \DateTimeZone('UTC'));
        $new_date = $new_date->modify("+30 day");
        $new_date = $new_date->format('Y-m-d H:i:s');

        $borrow->return_date = $new_date;

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

}
