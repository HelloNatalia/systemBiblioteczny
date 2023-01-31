<?php

namespace backend\controllers;

class ReadersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
