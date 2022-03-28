<?php

namespace common\models;

use cornernote\linkall\LinkAllBehavior;
use Yii;

/**
 * This is the model class for table "{{%food_order}}".
 *
 * @property int $food_order_id
 * @property int $customer_id
 * @property int|null $apartment_id
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int $dish_ids
 *
 * @property Apartment $apartment
 * @property Customer $customer
 * @property FoodOrderType[] $foodOrderTypes
 */
class FoodOrder extends \yii\db\ActiveRecord
{
    const STATUS_ARCHIVE   = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 2;

    public $dish_ids;

    /*public function behaviors()
    {
        return [
            LinkAllBehavior::class,
        ];
    }*/

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%food_order}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'apartment_id'], 'required'],
            [['customer_id', 'apartment_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['apartment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Apartment::class, 'targetAttribute' => ['apartment_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id']],
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
            'customer_id' => 'Клієнт',
            'apartment_id' => 'Садиба',
            'status' => 'Статус замовлення',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'dish_ids' => 'Страви',
        ];
    }

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Чернетка',
            self::STATUS_PUBLISHED => 'Активне',
            self::STATUS_ARCHIVE => 'Виконане',
        ];
    }

    /**
     * Gets query for [[Apartment]].
     *
     * @return \yii\db\ActiveQuery| Apartment
     */
    public function getApartment()
    {
        return $this->hasOne(Apartment::class, ['id' => 'apartment_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CustomerQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[FoodOrderTypes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodOrderTypeQuery
     */
    public function getFoodOrderTypes()
    {
        return $this->hasMany(FoodOrderType::class, ['order_id' => 'id'])->orderBy('order_type');//->joinWith('foodOrderTypeItems');
    }

    public function getFoodOrderTypeItems()
    {
        return $this->hasMany(FoodOrderTypeItem::class, ['order_type_id' => 'id'])
            ->viaTable('food_order_type', ['order_id'=>'id'])->indexBy('id');
    }

    /**
     * Gets query for [[FoodOrderTypes][FoodOrderTypeItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodOrderTypeQuery
     */
//    public function getFoodOrderTypesWithItems()
//    {
//        //return $this->hasMany(FoodOrderType::class, ['order_id' => 'food_order_id'])->joinWith('foodOrderTypeItems');
//        return $this->hasMany(FoodOrderType::class, ['order_id' => 'food_order_id'])->indexBy('food_order_type_id')->joinWith('foodOrderTypeItems');
//        /*return $this->hasMany(FoodOrderTypeItem::class, ['order_type_id' => 'food_order_type_id'])
//            ->viaTable('food_order_type', ['order_id'=>'food_order_id'], function ($query){
//            $query->indexBy('food_order_type_id');
//            return $query;
//        });*/
//    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\FoodOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\FoodOrderQuery(get_called_class());
    }

    /*public function afterFind()
    {
        //return $this->foodOrderTypesWithItems;//Food::find()->all();//делаем чтобы в полях select2 отображался value, без него не будет отображаться
    }*/

    public function afterSave($insert, $changedAttributes)
    {
        $dishes = [];
        if (is_array($this->foodOrderTypeItems)){
            foreach ($this->foodOrderTypeItems as $dish_id) {
                $dish = FoodOrderTypeItem::findOne($dish_id);
                if ($dish) {
                    $dishes[] = $dish;
                }
            }
        }
        //$this->linkAll('foodOrderTypeItems', $changedAttributes, $dishes);
        parent::afterSave($insert, $changedAttributes);
    }
}
