<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "autors".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $country
 */
class Autors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'country'], 'required'],
            [['name', 'country'], 'string', 'max' => 100],
            [['surname'], 'string', 'max' => 150],
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
            'country' => 'Country',
        ];
    }
}
