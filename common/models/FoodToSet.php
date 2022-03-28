<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%food_to_set}}".
 *
 * @property int $food_id
 * @property int $set_id
 *
 * @property Food $food
 * @property FoodSet $set
 */
class FoodToSet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%food_to_set}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id', 'set_id'], 'required'],
            [['food_id', 'set_id'], 'integer'],
            [['food_id', 'set_id'], 'unique', 'targetAttribute' => ['food_id', 'set_id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::class, 'targetAttribute' => ['food_id' => 'id']],
            [['set_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodSet::class, 'targetAttribute' => ['set_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'food_id' => 'Food ID',
            'set_id' => 'Set ID',
        ];
    }

    /**
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::class, ['id' => 'food_id']);
    }

    /**
     * Gets query for [[Set]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodSetQuery
     */
    public function getSet()
    {
        return $this->hasOne(FoodSet::class, ['id' => 'set_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FoodToSetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FoodToSetQuery(get_called_class());
    }
}
