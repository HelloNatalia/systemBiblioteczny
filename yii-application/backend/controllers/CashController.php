<?php

namespace backend\controllers;

use backend\models\Borrow;
use backend\models\Prices;
use yii\db\Expression;

class CashController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['returned' => 0])->andWhere(['<', 'return_date', new Expression('NOW()')])->orderBy(['return_date' => SORT_ASC])->all();
        $price = Prices::find()->one();
        return $this->render('index', ['models' => $models, 'price' => $price]);
    }

}
