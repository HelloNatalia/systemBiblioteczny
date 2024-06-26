<?php

namespace backend\controllers;

use Yii;
use backend\models\Reader;
use backend\models\SearchReader;
use backend\models\SearchBooks;
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
        $models = $searchModel->search()[0];
        $pages = $searchModel->search()[1];

        $readersData = $this->getReadersList();

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'pages' => $pages,
            'readersData' => $readersData,
        ]);
    }

    public function actionReader($id)
    {
        $model = Reader::find()->leftJoin('address', 'reader.address_id = address.id')->where(['reader.id' => $id])->one();
        $query = Borrow::find()->leftJoin('reader', 'borrow.reader_id = reader.id')->leftJoin('books', 'books.id = borrow.book_id')->andWhere(['reader.id' => $model->id])->andWhere(['borrow.returned' => 0]);
        $searchModel = new SearchBooks();

        if(Yii::$app->request->get('clear') == 1) {
            $searchModel->clearSearchParams();
            return $this->redirect(['reader', 'id' => $id]);
        } 

        $searchModel->load($searchModel->getSearchParams());
        $books = $searchModel->search($query, '')[0];
        $pages = $searchModel->search($query, '')[1];

        return $this->render('reader', [
            'model' => $model,
            'books' => $books,
            'pages' => $pages,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionCreate()
    {
        $reader = new Reader();
        $address = new Address();

        if($reader->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()))
        {
            $ifexists = $this->readerExists($reader);
            $address->postal_code = $this->postalCodeConvert($address);

            if($ifexists){
                return $this->render('create', ['reader' => $reader, 'address' => $address, 'exists_info' => 'Czytelnik o takim numerze PESEL jest już zarejestrowany']);
            }
            else if(!$ifexists && $address->save(false)){
                $reader->address_id = $address->id;
                if($reader->save(false)){
                    Yii::$app->session->setFlash('success', 'Utworzono nowego czytelnika!');
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
        $address->postal_code = (int) str_replace("-", "", $address->postal_code);

        if($reader->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()))
        {
            $pesel = Reader::findOne(['id' => $id]);
            $address->postal_code = $this->postalCodeConvert($address);

            if($reader->PESEL == $pesel->PESEL) $ifexists = false;
            else $ifexists = $this->readerExists($reader);
            if($ifexists){
                return $this->render('update', ['reader' => $reader, 'address' => $address, 'exists_info' => 'Czytelnik o takim numerze PESEL jest już zarejestrowany']);
            }
            else if(!$ifexists && $address->save(false)){
                $reader->address_id = $address->id;
                if($reader->save(false)){
                    Yii::$app->session->setFlash('success', 'Zaaktualizowano informacje o czytelniku!');
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

    // public function actionDelete($id)
    // {
    //     if($reader = Reader::findOne(['id' => $id])){
    //         if($address = Address::findOne(['id' => $reader->address_id])){
    //             if($reader->delete() && $address->delete()){
    //                 Yii::$app->session->setFlash('success', 'Usunięto czytelnika!');
    //                 return $this->redirect(['index']);
    //             }
    //         }
    //     }
    // }

    private function readerExists($model)
    {
        return Reader::find()->where(['like', 'PESEL', $model->PESEL, false])->one();
    }

    private function postalCodeConvert($model)
    {
        $postal_code = (string) $model->postal_code;
        return substr($postal_code, 0, 2) . "-" . substr($postal_code, 2);
    }

    private function getReadersList()
    {
        $models = Reader::find()->all();
        $readersData = [];
        foreach($models as $model) {
            $readersData[$model->id] = $model->id . " - " . $model->name . " " . $model->surname . " PESEL: " . $model->PESEL;
        }
        return $readersData;
    }

}
