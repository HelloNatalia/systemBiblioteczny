<?php

namespace backend\controllers;

use Yii;
use backend\models\Reader;
use backend\models\Address;


class ReadersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = Reader::find()->orderBy(['surname' => SORT_ASC])->all();

        return $this->render('index', ['models' => $models]);
    }

    public function actionReader($id)
    {
        $model = Reader::find()->leftJoin('address', 'reader.address_id = address.id')->where(['reader.id' => $id])->one();

        return $this->render('reader', ['model' => $model]);
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

        return $this->render('create', ['reader' => $reader, 'address' => $address]);
    }

}
