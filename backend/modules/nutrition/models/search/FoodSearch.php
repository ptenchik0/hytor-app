<?php

namespace backend\modules\nutrition\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Food;

/**
 * FoodSearch represents the model behind the search form of `common\models\Food`.
 */
class FoodSearch extends Food
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'outlet', 'outlet_amount', 'dish_type', 'type', 'status', 'sort_order'], 'integer'],
            [['title', 'description'], 'safe'],
            [['price'], 'number'],
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
        $query = Food::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'price' => 'ROUND('.$this->price.', 0)',//$this->price,
            'price' => $this->price,//$this->price,
            'outlet' => $this->outlet,
            'outlet_amount' => $this->outlet_amount,
            'dish_type' => $this->dish_type,
            'type' => $this->type,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
