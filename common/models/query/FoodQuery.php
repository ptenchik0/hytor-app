<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Food]].
 *
 * @see \common\models\Food
 */
class FoodQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Food[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Food|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
