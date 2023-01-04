<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "borrow".
 *
 * @property int $id
 * @property string $date_time
 * @property int $reader_id
 * @property int $book_id
 * @property string $return_date
 *
 * @property Books $book
 * @property Reader $reader
 */
class Borrow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'borrow';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'return_date'], 'safe'],
            [['reader_id', 'book_id', 'return_date'], 'required'],
            [['reader_id', 'book_id'], 'integer'],
            [['reader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reader::class, 'targetAttribute' => ['reader_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::class, 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_time' => 'Date Time',
            'reader_id' => 'Reader ID',
            'book_id' => 'Book ID',
            'return_date' => 'Return Date',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::class, ['id' => 'book_id']);
    }

    /**
     * Gets query for [[Reader]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReader()
    {
        return $this->hasOne(Reader::class, ['id' => 'reader_id']);
    }
}
