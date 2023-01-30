<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property int $subscription_id
 * @property string $subscription_type
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property int $customer_id
 *
 * @property Customer $customer
 * @property SubscriptionType[] $subscriptionTypes
 */
class Subscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subscription_id', 'subscription_type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'customer_id'], 'required'],
            [['subscription_id', 'customer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['subscription_type', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['subscription_id'], 'unique'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'customer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subscription_id' => 'Subscription ID',
            'subscription_type' => 'Subscription Type',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['customer_id' => 'customer_id']);
    }

    /**
     * Gets query for [[SubscriptionTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptionTypes()
    {
        return $this->hasMany(SubscriptionType::class, ['subscription_id' => 'subscription_id']);
    }
}
