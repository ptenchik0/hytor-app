<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[FoodOrder]].
 *
 * @see FoodOrder
 */
class FoodOrderQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return FoodOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FoodOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
