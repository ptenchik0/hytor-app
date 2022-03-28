<?php

namespace backend\modules\nutrition\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodSet;

/**
 * FoodSetSearch represents the model behind the search form of `common\models\FoodSet`.
 */
class FoodSetSearch extends FoodSet
{
    //public $dish_ids;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'status', 'dish_ids'], 'integer'],
            [['title', 'description'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FoodSet::find();
        /*if (!empty($this->dish_ids)){
        }*/
        $query->joinWith('foods');

        // show RAW SQL query
        $cc = $query->createCommand()->getRawSql();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $this->tableName() . 'id' => $this->id,
            $this->tableName() . 'type' => $this->type,
            $this->tableName() . 'status' => $this->status,
        ]);



        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        $query->andFilterWhere([
            'food.id' => $this->dish_ids,
        ]);

        // show RAW SQL query
        $cc = $query->createCommand()->getRawSql();

        return $dataProvider;
    }
}
