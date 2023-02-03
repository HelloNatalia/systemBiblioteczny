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
 * @property int $returned
 * @property string|null $returned_date
 * @property int $extend_quantity
 *
 * @property Books $book
 * @property Reader $reader
 * @property Returns[] $returns
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
            [['date_time', 'reader_id', 'book_id', 'return_date', 'returned', 'extend_quantity'], 'required'],
            [['date_time', 'return_date', 'returned_date'], 'safe'],
            [['reader_id', 'book_id', 'returned', 'extend_quantity'], 'integer'],
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
            'returned' => 'Returned',
            'returned_date' => 'Returned Date',
            'extend_quantity' => 'Extend Quantity',
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

    /**
     * Gets query for [[Returns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReturns()
    {
        return $this->hasMany(Returns::class, ['borrow_id' => 'id']);
    }
}
