<?php

namespace common\models;

use cornernote\linkall\LinkAllBehavior;
use Yii;

/**
 * This is the model class for table "{{%food_set}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $type snidanok/obid/vecherya
 * @property int $status
 * @property int $dish_ids
 *
 * @property FoodToSet[] $foodToSets
 * @property Food[] $foods
 */
class FoodSet extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    const TYPE_SNIDANOK = 0;
    const TYPE_OBID = 1;
    const TYPE_VECHERYA = 2;

    public $dish_ids;

    public function behaviors()
    {
        return [
            LinkAllBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%food_set}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['type', 'status'], 'integer'],
            [['title'], 'string', 'max' => 191],
            [['dish_ids'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'description' => 'Опис',
            'type' => 'Трапеза',
            'status' => 'Статус',
            'dish_ids' => 'Страви',
        ];
    }

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Прихований',
            self::STATUS_PUBLISHED => 'Активний',
        ];
    }

    /**
     * @return array food type (snidanok/obid/vecherya) list
     */
    public static function rationType()
    {
        return [
            self::TYPE_SNIDANOK => 'Сніданок',
            self::TYPE_OBID => 'Обід',
            self::TYPE_VECHERYA => 'Вечеря',
        ];
    }

    /**
     * Gets query for [[FoodToSets]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodToSetQuery
     */
    public function getFoodToSets()
    {
        return $this->hasMany(FoodToSet::className(), ['set_id' => 'id']);
    }

    /**
     * Gets query for [[Foods]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodQuery
     */
    public function getFoods()
    {
        return $this->hasMany(Food::class, ['id' => 'food_id'])->viaTable('{{%food_to_set}}', ['set_id' => 'id']); // ->active(); select only active items;
    }

    public function afterFind()
    {
        return $this->dish_ids = $this->foods;//делаем чтобы в полях select2 отображался value, без него не будет отображаться
    }

    public function afterSave($insert, $changedAttributes)
    {
        $dishes = [];
        if (is_array($this->dish_ids)){
            foreach ($this->dish_ids as $dish_id) {
                $dish = Food::findOne($dish_id);
                if ($dish) {
                    $dishes[] = $dish;
                }
            }
        }
        $this->linkAll('foods', $dishes);
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FoodSetQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FoodSetQuery(get_called_class());
    }
}
