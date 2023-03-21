<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscription_type".
 *
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property string $created_at
 * @property string $payment_way
 * @property string $created_by
 * @property string $updated_by
 * @property string $updated_at
 * @property int $subscription_id
 *
 * @property Subscription $subscription
 */
class SubscriptionType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscription_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'created_at', 'payment_way', 'created_by', 'updated_by', 'updated_at'], 'required'],
            [['amount', 'subscription_id'], 'integer'],
            [['name', 'created_at', 'payment_way', 'created_by', 'updated_by', 'updated_at'], 'string', 'max' => 60],
            [['subscription_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::class, 'targetAttribute' => ['subscription_id' => 'subscription_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'payment_way' => 'Payment Way',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'subscription_id' => 'Subscription ID',
        ];
    }

    /**
     * Gets query for [[Subscription]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscription()
    {
        return $this->hasOne(Subscription::class, ['subscription_id' => 'subscription_id']);
    }
}
