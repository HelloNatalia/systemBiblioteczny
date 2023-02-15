<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;

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
class SearchReturns extends \yii\db\ActiveRecord
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
            [['id', 'borrow_id', 'days'], 'integer'],
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

    public function getSearchParams()
    {
        $params = Yii::$app->request->post();

        if(count($params) <= 1) {
            $params = Yii::$app->session->get('SearchReturns');

            if(is_array($params)) return $params;
            else return [];
        } else {
            Yii::$app->session->set('SearchReturns', $params);
        }
        return $params;
    }

    public function clearSearchParams()
    {
        Yii::$app->session->remove('SearchReturns');
    }


    public function search($query, $sort)
    {
        $query = $query
                    ->andFilterWhere(['returns.borrow_id' => $this->borrow_id])
                    ->andFilterWhere(['like', 'returns.returned_date', $this->returned_date]);
        if($sort == 'd1asc') $query = $query->orderBy(['borrow.date_time' => SORT_ASC]);
        else if($sort == 'd1desc') $query = $query->orderBy(['borrow.date_time' => SORT_DESC]);
        else if($sort == 'd2asc') $query = $query->orderBy(['borrow.return_date' => SORT_ASC]);
        else if($sort == 'd2desc') $query = $query->orderBy(['borrow.return_date' => SORT_DESC]);
        else if($sort == 'd3asc') $query = $query->orderBy(['returns.returned_date' => SORT_ASC]);
        else if($sort == 'd3desc') $query = $query->orderBy(['returns.returned_date' => SORT_DESC]);
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return [$models, $pages];
    }
}
