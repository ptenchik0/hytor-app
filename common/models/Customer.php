<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%customer}}".
 *
 * @property int $id
 * @property string $username
 * @property string|null $fio
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string $phone
 * @property string|null $verification_token
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $logged_at
 * @property int|null $postal_code
 * @property string|null $street
 * @property string|null $city
 *
 * @property ApartmentOrder[] $apartmentOrders
 * @property FoodOrder[] $foodOrders
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'phone'], 'required'],
            [['status', 'created_at', 'updated_at', 'logged_at', 'postal_code'], 'integer'],
            [['username', 'fio', 'password_hash', 'password_reset_token', 'email', 'phone', 'verification_token', 'street', 'city'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'fio' => 'Fio',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'phone' => 'Phone',
            'verification_token' => 'Verification Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'logged_at' => 'Logged At',
            'postal_code' => 'Postal Code',
            'street' => 'Street',
            'city' => 'City',
        ];
    }

    /**
     * Gets query for [[ApartmentOrders]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ApartmentOrderQuery
     */
    public function getApartmentOrders()
    {
        return $this->hasMany(ApartmentOrder::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[FoodOrders]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\FoodOrderQuery
     */
    public function getFoodOrders()
    {
        return $this->hasMany(FoodOrder::className(), ['customer_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CustomerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CustomerQuery(get_called_class());
    }
}
