<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "reader".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property int $address_id
 * @property string $birth_date
 * @property string $PESEL
 * @property string $email
 * @property string $tel_number
 *
 * @property Address $address
 * @property Borrow[] $borrows
 */
class Reader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'address_id', 'birth_date', 'PESEL', 'email', 'tel_number'], 'required'],
            [['address_id'], 'integer'],
            [['birth_date'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['surname'], 'string', 'max' => 150],
            [['PESEL'], 'string', 'max' => 11],
            [['PESEL'], 'unique'],
            [['tel_number'], 'string', 'max' => 15],
            [['address_id'], 'exist', 'skipOnError' => true, 'targetClass' => Address::class, 'targetAttribute' => ['address_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'address_id' => 'Address ID',
            'birth_date' => 'Birth Date',
            'PESEL' => 'Pesel',
            'email' => 'Email',
            'tel_number' => 'Tel Number',
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::class, ['id' => 'address_id']);
    }

    /**
     * Gets query for [[Borrows]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrows()
    {
        return $this->hasMany(Borrow::class, ['reader_id' => 'id']);
    }

    public function readersArray()
    {
        $r_items = array();
        $readers = $this->find()->all();
        foreach($readers as $reader){
            $r_items[$reader->id] = $reader->id . ' - ' . $reader->name . ' ' . $reader->surname . ' - PESEL: ' . $reader->PESEL;
        }
        return $r_items;
    }
}
