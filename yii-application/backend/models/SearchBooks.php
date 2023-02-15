<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;


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
class SearchBooks extends \yii\db\ActiveRecord
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
            [['id', 'autor_id', 'category_id', 'quantity'], 'integer'],
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

    public function getSearchParams()
    {
        $params = Yii::$app->request->post();

        if(count($params) <= 1) {
            $params = Yii::$app->session->get('SearchBooks');

            if(is_array($params)) return $params;
            else return [];
        } else {
            Yii::$app->session->set('SearchBooks', $params);
        }
        return $params;
    }

    public function clearSearchParams()
    {
        Yii::$app->session->remove('SearchBooks');
    }

    public function search($query, $q_sort)
    {
        $query = $query
                    ->andFilterWhere(['books.id' => $this->id])
                    ->andFilterWhere(['publ_year' => $this->publ_year])
                    ->andFilterWhere(['title' => $this->title])
                    ->andFilterWhere(['autor_id' => $this->autor_id])
                    ->andFilterWhere(['category_id' => $this->category_id]);

        if($q_sort == 'asc') $query = $query->orderBy(['quantity' => SORT_ASC]);
        else if($q_sort == 'desc') $query = $query->orderBy(['quantity' => SORT_DESC]);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return [$models, $pages];
    }
}
