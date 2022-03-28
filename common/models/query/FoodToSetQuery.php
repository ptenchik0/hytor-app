<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[FoodToSet]].
 *
 * @see FoodToSet
 */
class FoodToSetQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FoodToSet[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FoodToSet|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
