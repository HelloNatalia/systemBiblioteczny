<?php

namespace backend\models;

use Yii;


/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property int $autor_id
 * @property int $category_id
 * @property string $publ_year
 * @property string $description
 * @property string $img
 *
 * @property Autors $autor
 * @property Borrow[] $borrows
 * @property Categories $category
 */
class Books extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'autor_id', 'category_id', 'publ_year', 'description', 'img', 'quantity'], 'required'],
            [['autor_id', 'category_id', 'quantity'], 'integer'],
            [['publ_year'], 'safe'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['img'], 'string', 'max' => 300],
            [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Autors::class, 'targetAttribute' => ['autor_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'autor_id' => 'Autor ID',
            'category_id' => 'Category ID',
            'publ_year' => 'Publ Year',
            'description' => 'Description',
            'img' => 'Img',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autors::class, ['id' => 'autor_id']);
    }

    /**
     * Gets query for [[Borrows]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBorrows()
    {
        return $this->hasMany(Borrow::class, ['book_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }

    public function booksArray()
    {
        $b_items = array();
        $books = $this->find()->leftJoin('autors', 'autors.id = books.autor_id')->where(['>', 'quantity', 0])->all();
        foreach($books as $book) {
            $b_items[$book->id] = $book->id . ' - ' . $book->title . ' - ' . $book->autor->name . ' ' . $book->autor->surname . ' - sztuk: ' . $book->quantity;
        }
        return $b_items;
    }
}
