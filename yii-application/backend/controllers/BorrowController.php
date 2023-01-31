<?php

namespace backend\controllers;

use backend\models\Borrow;
use backend\models\Books;
use backend\models\Reader;
use Yii;
use DateTime;

class BorrowController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Borrow::find()->leftJoin('reader', 'reader.id = borrow.reader_id')->leftJoin('books', 'books.id = borrow.book_id')->where(['returned' => 0])->orderBy(['return_date' => SORT_ASC])->all();
        
        return $this->render('index', ['models' => $models]);
    }

    public function actionExtend($id)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $return_date = new DateTime($borrow->return_date);
        $now = new DateTime('now', new \DateTimeZone('UTC'));

        if($return_date < $now) {
            return $this->render('long-borrow', ['id' => $id]);
        } else {
            $return_date->modify("+30 day");
            $return_date = $return_date->format('Y-m-d H:i:s');
            $borrow->return_date = $return_date;
            if($borrow->save(false)) {
                return $this->redirect(['index']);
            }   
        }
    }

    public function actionEnd($id)
    {
        $borrow = Borrow::findOne(['id' => $id]);
        $return_date = new DateTime($borrow->return_date);
        $now = new DateTime('now', new \DateTimeZone('UTC'));

        if($return_date < $now) {
            return $this->render('pay-borrow', ['id' => $id]);
        } else {
            $borrow->returned = 1;
            if($borrow->save(false)) {
                return $this->redirect(['index']);
            }
        }
    }

}
