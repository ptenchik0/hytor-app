<?php

namespace common\models;

use Yii;
use yii\behaviors\AttributeTypecastBehavior;

/**
 * This is the model class for table "{{%food}}".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float|null $price
 * @property int|null $outlet
 * @property int|null $outlet_amount
 * @property int|null $dish_type vegan/post
 * @property int $type snidanok/obid/vecherya
 * @property integer $status
 * @property int $sort_order
 *
 * @property FoodOrderTypeItem[] $foodOrderTypeItems
 * @property FoodToSet $foodToSet
 */
class Food extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    const TYPE_SNIDANOK = 0;
    const TYPE_OBID = 1;
    const TYPE_VECHERYA = 2;

    const DISH_TYPE_DEFAULT = 0;
    const DISH_TYPE_VEGAN = 1;
    const DISH_TYPE_POST = 2;

    const OUTLET_GRAMM = 0;
    const OUTLET_SHTUK = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%food}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            //[['price'], 'number', 'numberPattern' => '/^\d+(.\d{1,2})?$/'],
            [['outlet', 'outlet_amount', 'dish_type', 'type', 'status', 'sort_order'], 'integer'],
            [['title'], 'string', 'max' => 191],
        ];
    }

    public function behaviors()
    {
        return [
            'typecast' => [
                'class' => AttributeTypecastBehavior::class,
                'typecastAfterValidate' => false,
                'typecastAfterFind' => true
                // 'attributeTypes' will be composed automatically according to `rules()`
            ],
        ];
    }

    public function fasdfa(){

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва страви',
            'description' => 'Опис',
            'price' => 'Ціна',
            'outlet' => 'Вимірювання',
            'outlet_amount' => 'Вихід грам / К-ть порцій',
            'dish_type' => 'Раціон',
            'type' => 'Трапеза',
            'status' => 'Статус',
            'sort_order' => 'Порядок',
        ];
    }

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Прихована',
            self::STATUS_PUBLISHED => 'Активна',
        ];
    }

    /**
     * @return array food type (snidanok/obid/vecherya) list
     */
    public static function rationTypes()
    {
        return [
            self::TYPE_SNIDANOK => 'Сніданок',
            self::TYPE_OBID => 'Обід',
            self::TYPE_VECHERYA => 'Вечеря',
        ];
    }

    /**
     * @return array dish type (default/post/vegan) list
     */
    public static function dishItemTypes()
    {
        return [
            self::DISH_TYPE_DEFAULT => 'Для всіх',
            self::DISH_TYPE_VEGAN => 'Вегетаріанська',
            self::DISH_TYPE_POST => 'Пісна страва',
        ];
    }

    /**
     * @return array dish type (default/post/vegan) list
     */
    public static function outletTypes()
    {
        return [
            self::OUTLET_GRAMM => 'грам',
            self::OUTLET_SHTUK => 'шт',
        ];
    }

    // remove food from sets table when status == 0
    /*public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if($this->isAttributeChanged('status')){
            FoodToSet::deleteAll(['food_id' => $this->id]);
        }
        return true;
    }*/

    /**
     * Gets query for [[FoodOrderTypeItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodOrderTypeItemQuery
     */
    /*public function getFoodOrderTypeItems()
    {
        return $this->hasMany(FoodOrderTypeItem::class, ['food_id' => 'id']);
    }*/

    /**
     * Gets query for [[FoodToSet]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodToSetQuery
     */
    public function getFoodToSet()
    {
        return $this->hasOne(FoodToSet::class, ['food_id' => 'id']);
    }

    public static function getDishes(){
        return self::find()->active()->all();
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FoodQuery(get_called_class());
    }
}
