<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $customer_id
 * @property string $fullname
 * @property string $subscription
 * @property int $idn
 * @property string $telephone
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property int $item_id
 *
 * @property Item $item
 * @property Subscription[] $subscriptions
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'subscription', 'idn', 'telephone', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['item_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
            [['fullname', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['subscription'], 'string', 'max' => 60],
            [['telephone'], 'string', 'max' => 15],
            [['idn'], 'string', 'max' => 16,'min'=>16],
            // [['idn'], 'unique'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'customer_id' => 'Customer ID',
            'fullname' => 'Full name',
            'subscription' => 'Subscription',
            'idn' => 'ID No',
            'telephone' => 'Telephone',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'item_id' => 'Item ID',
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::class, ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[Subscriptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::class, ['customer_id' => 'customer_id']);
    }
}
