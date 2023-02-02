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
class SearchReader extends \yii\db\ActiveRecord
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
            [['address_id', 'id'], 'integer'],
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

    // ------------------------------------------------------------------ //

    public function getSearchParams()
    {
        $params = Yii::$app->request->post();

        if(count($params) <= 1) {
            $params = Yii::$app->session->get('SearchReader');

            if(is_array($params)) return $params;
            else return [];
        } else {
            Yii::$app->session->set('SearchReader', $params);
        }
        return $params;
    }

    public function clearSearchParams()
    {
        Yii::$app->session->remove('SearchReader');
    }

    public function search()
    {
        $models = Reader::find()
                        ->orderBy(['surname' => SORT_ASC])
                        ->andFilterWhere(['id' => $this->id])
                        ->andFilterWhere(['like', 'name', $this->name])
                        ->andFilterWhere(['like', 'surname', $this->surname])
                        ->all();
        // $models = $models
        //             ->andFilterWhere(['borrow.id' => $this->id])
        //             ->andFilterWhere(['borrow.reader_id' => $this->reader_id])
        //             ->andFilterWhere(['borrow.book_id' => $this->book_id])
        //             ->andFilterWhere(['like', 'borrow.date_time', $this->date_time])
        //             ->andFilterWhere(['like', 'borrow.return_date', $this->return_date])
        //             ->all();
        return $models;
    }
}
