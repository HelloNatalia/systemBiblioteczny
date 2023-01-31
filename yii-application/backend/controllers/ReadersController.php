<?php

namespace backend\controllers;

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

}
