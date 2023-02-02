<?php

namespace backend\controllers;

use Yii;
use backend\models\Reader;
use backend\models\SearchReader;
use backend\models\Address;
use backend\models\Borrow;


class ReadersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new SearchReader();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['/readers']);
        }

        $searchModel->load($searchModel->getSearchParams());
        $models = $searchModel->search();

        return $this->render('index', ['models' => $models, 'searchModel' => $searchModel]);
    }

    public function actionReader($id)
    {
        $model = Reader::find()->leftJoin('address', 'reader.address_id = address.id')->where(['reader.id' => $id])->one();
        $books = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['reader.id' => $model->id])->andWhere(['borrow.returned' => 0])->all();
        

        return $this->render('reader', [
            'model' => $model,
            'books' => $books,
        ]);
    }

    public function actionCreate()
    {
        $reader = new Reader();
        $address = new Address();

        if($reader->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()))
        {
            $ifexists = Reader::find()->where(['like', 'PESEL', $reader->PESEL, false])->one();
            if($ifexists){
                return $this->render('create', ['reader' => $reader, 'address' => $address, 'exists_info' => 'Czytelnik o takim numerze PESEL jest już zarejestrowany']);
            }
            else if(!$ifexists && $address->save(false)){
                $reader->address_id = $address->id;
                if($reader->save(false)){
                    return $this->redirect(['reader', 'id' => $reader->id]);
                }
            }
        }

        return $this->render('create', ['reader' => $reader, 'address' => $address, 'exists_info' => ""]);
    }

    public function actionUpdate($id)
    {
        $reader = Reader::findOne(['id' => $id]);
        $address = Address::findOne(['id' => $reader->address_id]);

        if($reader->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()))
        {
            $pesel = Reader::findOne(['id' => $id]);
            if($reader->PESEL == $pesel->PESEL){
                $ifexists = false;
            }
            else {
                $ifexists = Reader::find()->where(['like', 'PESEL', $reader->PESEL, false])->one();
            }
            if($ifexists){
                return $this->render('update', ['reader' => $reader, 'address' => $address, 'exists_info' => 'Czytelnik o takim numerze PESEL jest już zarejestrowany']);
            }
            else if(!$ifexists && $address->save(false)){
                $reader->address_id = $address->id;
                if($reader->save(false)){
                    return $this->redirect(['reader', 'id' => $reader->id]);
                }
            }
        }

        return $this->render('update', ['reader' => $reader, 'address' => $address, 'exists_info' => ""]);
    }

    public function actionDeleteView($id)
    {
        $model = Reader::findOne(['id' => $id]);
        return $this->render('delete-view', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if($reader = Reader::findOne(['id' => $id])){
            if($address = Address::findOne(['id' => $reader->address_id])){
                if($reader->delete() && $address->delete()){
                    return $this->redirect(['index']);
                }
            }
        }
    }

}
