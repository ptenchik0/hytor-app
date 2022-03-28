<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "apartment".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $image
 * @property string|null $price
 * @property int $display_order
 * @property int $status
 */
class Apartment extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT     = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apartment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description', 'image'], 'string'],
            [['price'], 'filter', 'filter' => function($value){
                return is_array($value) ? json_encode($value) : $value;
            }],
            [['display_order', 'status'], 'integer'],
            [['name'], 'string', 'max' => 190],
            [['display_order', 'status'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва',
            'description' => 'Description',
            'image' => 'Зображення',
            'price' => 'Ціна',
            'display_order' => 'Порядок',
            'status' => 'Опубліковано',
        ];
    }

    /**
     * @return array statuses list
     */
    public static function statuses()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    public function getMyPrice()
    {
        return json_decode($this->price);
    }

    public function setMyPrice($value)
    {
        $this->price = json_encode($value);
    }

    /**
     * @return ApartmentQuery
     */
    /*public static function find()
    {
        return new ApartmentQuery(get_called_class());
    }*/
}
