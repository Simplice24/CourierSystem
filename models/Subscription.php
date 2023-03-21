<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property int $subscription_id
 * @property string $customer
 * @property string $subscription_type
 * @property int $amount
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 * @property int $customer_id
 *
 * @property Customer $customer0
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
            [['customer', 'subscription_type', 'amount', 'created_at', 'created_by', 'updated_at', 'updated_by', 'customer_id'], 'required'],
            [['amount', 'created_at', 'updated_at', 'customer_id'], 'integer'],
            [['customer'], 'string', 'max' => 225],
            [['subscription_type', 'created_by', 'updated_by'], 'string', 'max' => 60],
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
            'customer' => 'Customer',
            'subscription_type' => 'Subscription Type',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'customer_id' => 'Customer ID',
        ];
    }

    /**
     * Gets query for [[Customer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer0()
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
