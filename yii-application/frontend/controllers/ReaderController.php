<?php

namespace frontend\controllers;

use Yii;
use DateTime;
use backend\models\Reader;
use backend\models\SearchReader;
use backend\models\SearchBooks;
use backend\models\Address;
use backend\models\Borrow;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use backend\models\Days;


class ReaderController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'extend-days', 'extend'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $id = Yii::$app->user->identity->username;
        $model = Reader::find()->leftJoin('address', 'reader.address_id = address.id')->where(['reader.id' => $id])->one();
        $query = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['reader.id' => $model->id])->andWhere(['borrow.returned' => 0]);
        $searchModel = new SearchBooks();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['index']);
        } 

        $searchModel->load($searchModel->getSearchParams());
        $books = $searchModel->search($query, '')[0];
        $pages = $searchModel->search($query, '')[1];

        return $this->render('index', [
            'model' => $model,
            'books' => $books,
            'pages' => $pages,
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
        $borrow->return_date = $borrow->modifyDate($return_date, $days);
        $borrow->extend_quantity += 1;

        if($borrow->save(false)) {
            Yii::$app->session->setFlash('success', 'Udało się przedłużyć wypożyczenie!');
            return $this->redirect(['index']);
        }   
    }
}
