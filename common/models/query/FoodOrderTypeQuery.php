<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\FoodOrderType]].
 *
 * @see \common\models\FoodOrderType
 */
class FoodOrderTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\FoodOrderType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\FoodOrderType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
