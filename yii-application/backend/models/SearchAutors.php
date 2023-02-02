<?php

namespace backend\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "autors".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $country
 */
class SearchAutors extends \yii\db\ActiveRecord
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


    public function getSearchParams()
    {
        $params = Yii::$app->request->post();

        if(count($params) <= 1) {
            $params = Yii::$app->session->get('SearchAutors');

            if(is_array($params)) return $params;
            else return [];
        } else {
            Yii::$app->session->set('SearchAutors', $params);
        }
        return $params;
    }

    public function clearSearchParams()
    {
        Yii::$app->session->remove('SearchAutors');
    }

    public function search($query)
    {
        $query = $query
                    ->andFilterWhere(['like', 'name', $this->name])
                    ->andFilterWhere(['like', 'surname', $this->surname])
                    ->andFilterWhere(['country' => $this->country]);
        
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return [$models, $pages];
    }
}
