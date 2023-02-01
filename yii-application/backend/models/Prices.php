<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prices".
 *
 * @property int $id
 * @property float $priceperday
 */
class Prices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prices';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['priceperday'], 'required'],
            [['priceperday'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'priceperday' => 'Priceperday',
        ];
    }
}
