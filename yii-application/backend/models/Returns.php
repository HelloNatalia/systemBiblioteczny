<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "returns".
 *
 * @property int $id
 * @property int $borrow_id
 * @property int $days
 * @property float $price
 * @property string $returned_date
 *
 * @property Borrow $borrow
 */
class Returns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'returns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['borrow_id', 'days', 'price', 'returned_date'], 'required'],
            [['borrow_id', 'days'], 'integer'],
            [['price'], 'number'],
            [['returned_date'], 'safe'],
            [['borrow_id'], 'exist', 'skipOnError' => true, 'targetClass' => Borrow::class, 'targetAttribute' => ['borrow_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'borrow_id' => 'Borrow ID',
            'days' => 'Days',
            'price' => 'Price',
            'returned_date' => 'Returned Date',
        ];
    }

    /**
     * Gets query for [[Borrow]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrow()
    {
        return $this->hasOne(Borrow::class, ['id' => 'borrow_id']);
    }
}
