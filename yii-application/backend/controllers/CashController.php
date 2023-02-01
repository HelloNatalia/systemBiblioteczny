<?php

namespace backend\controllers;

use backend\models\Borrow;
use backend\models\Prices;
use yii\db\Expression;
use yii\DateTime;
use backend\models\Autors;

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

}
