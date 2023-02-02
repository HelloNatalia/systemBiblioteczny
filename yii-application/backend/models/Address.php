<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property string $street
 * @property string $home
 * @property string $number
 * @property string $postal_code
 * @property string $city
 * @property string $country
 *
 * @property Reader[] $readers
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['street', 'home', 'postal_code', 'city', 'country'], 'required'],
            [['street'], 'string', 'max' => 150],
            [['home', 'number'], 'string', 'max' => 5],
            [['postal_code'], 'string', 'max' => 5],
            [['city', 'country'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street' => 'Street',
            'home' => 'Home',
            'number' => 'Number',
            'postal_code' => 'Postal Code',
            'city' => 'City',
            'country' => 'Country',
        ];
    }

    /**
     * Gets query for [[Readers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReaders()
    {
        return $this->hasMany(Reader::class, ['address_id' => 'id']);
    }
}
