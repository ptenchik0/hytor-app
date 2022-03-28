<?php

namespace backend\modules\nutrition\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodOrder;

/**
 * FoodOrderSearch represents the model behind the search form of `common\models\FoodOrder`.
 */
class FoodOrderSearch extends FoodOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_order_id', 'customer_id', 'apartment_id', 'status', 'created_at', 'updated_at'], 'integer'],
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
        $query = FoodOrder::find();

        $query->joinWith(['apartment a', 'customer c', 'foodOrderTypes t']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $cc = $query->createCommand()->getRawSql();

        // grid filtering conditions
        $query->andFilterWhere([
            'food_order_id' => $this->food_order_id,
            'customer_id' => $this->customer_id,
            'apartment_id' => $this->apartment_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
