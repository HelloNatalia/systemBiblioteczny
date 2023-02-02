<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;

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
class SearchBorrow extends \yii\db\ActiveRecord
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
            [['id', 'reader_id', 'book_id'], 'integer'],
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

    public function getSearchParams()
    {
        $params = Yii::$app->request->post();

        if(count($params) <= 1) {
            $params = Yii::$app->session->get('SearchBorrow');

            if(is_array($params)) return $params;
            else return [];
        } else {
            Yii::$app->session->set('SearchBorrow', $params);
        }
        return $params;
    }

    public function clearSearchParams()
    {
        Yii::$app->session->remove('SearchBorrow');
    }

    public function search($query, $sort)
    {
        $query = $query
                    ->andFilterWhere(['borrow.id' => $this->id])
                    ->andFilterWhere(['borrow.reader_id' => $this->reader_id])
                    ->andFilterWhere(['borrow.book_id' => $this->book_id])
                    ->andFilterWhere(['like', 'borrow.date_time', $this->date_time])
                    ->andFilterWhere(['like', 'borrow.return_date', $this->return_date]);
        if($sort == 'd1asc') $query = $query->orderBy(['date_time' => SORT_ASC]);
        else if($sort == 'd1desc') $query = $query->orderBy(['date_time' => SORT_DESC]);
        else if($sort == 'd2asc') $query = $query->orderBy(['return_date' => SORT_ASC]);
        else if($sort == 'd2desc') $query = $query->orderBy(['return_date' => SORT_DESC]);
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [$models, $pages];
    }
}
