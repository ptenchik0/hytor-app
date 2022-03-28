<?php

namespace backend\modules\nutrition\models\search;

use common\models\FoodOrderType;
use common\models\FoodOrderTypeItem;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FoodOrder;
use yii\helpers\ArrayHelper;

/**
 * FoodOrderSearch represents the model behind the search form of `common\models\FoodOrder`.
 */
class OrderSearch extends FoodOrderTypeItem
{
    public $apartment_id;
    public $order_type;
    public $serve_at;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['food_order_id', 'customer_id', 'apartment_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['quantity', 'apartment_id', 'order_type'], 'integer'],
            [['apartment_id'], 'safe']
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

        $query->joinWith(['apartment']);
        $query->joinWith(['customer']);
        //$query->joinWith(['food f']);
        //$query->joinWith(['orderType ot']);
        //$query->joinWith(['orderTypeWithOrder']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['apartment_id'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['apartment_id' => SORT_ASC],
            'desc' => ['apartment_id' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['order_type'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['order_type' => SORT_ASC],
            'desc' => ['order_type' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['serve_at'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['serve_at' => SORT_ASC],
            'desc' => ['serve_at' => SORT_DESC],
        ];

        $cc = $query->createCommand()->getRawSql();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'order_type_id' => 2
            'apartment_id' => $this->apartment_id,
            'order_type' => $this->order_type
        ]);

        $cc = $query->createCommand()->getRawSql();

        // grid filtering conditions
/*        $query->andFilterWhere([
            'food_order_id' => $this->food_order_id,
            'customer_id' => $this->customer_id,
            'apartment_id' => $this->apartment_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);*/

        return $dataProvider;
    }
}
