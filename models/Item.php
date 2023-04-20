<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $item_id
 * @property string $item_name
 * @property int $value
 * @property string $sender_name
 * @property string $sender_phone
 * @property string $sender_subscription
 * @property string $receiver_name
 * @property string $receiver_phone
 * @property int $receiver_id
 * @property string $departure
 * @property string $depature_date
 * @property string $departure_time
 * @property string $destination
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property int|null $manifest_id
 *
 * @property Customer[] $customers
 * @property Log $log
 * @property Manifest $manifest
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

     public $selected;
     public $quantity;
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_name', 'value', 'sender_name', 'sender_phone', 'sender_subscription', 'receiver_name', 'receiver_phone', 'receiver_id', 'departure', 'depature_date', 'departure_time', 'destination', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['value', 'manifest_id'], 'integer'],
            [['depature_date', 'departure_time', 'created_at', 'updated_at'], 'safe'],
            [['item_name', 'sender_name', 'receiver_name', 'departure', 'destination', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['sender_phone', 'receiver_phone'], 'string', 'max' => 15],
            [['sender_subscription'], 'string', 'max' => 10],
            [['receiver_id'],'string','max'=>16],
            [['manifest_id'], 'exist', 'skipOnError' => true, 'targetClass' => Manifest::class, 'targetAttribute' => ['manifest_id' => 'manifest_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'value' => 'Value',
            'sender_name' => 'Sender Name',
            'sender_phone' => 'Sender Phone',
            'sender_subscription' => 'Sender Subscription',
            'receiver_name' => 'Receiver Name',
            'receiver_phone' => 'Receiver Phone',
            'receiver_id' => 'Receiver ID',
            'departure' => 'Departure',
            'depature_date' => 'Depature Date',
            'departure_time' => 'Departure Time',
            'destination' => 'Destination',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'manifest_id' => 'Manifest ID',
        ];
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::class, ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[Log]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLog()
    {
        return $this->hasOne(Log::class, ['item_id' => 'item_id']);
    }

    /**
     * Gets query for [[Manifest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManifest()
    {
        return $this->hasOne(Manifest::class, ['manifest_id' => 'manifest_id']);
    }

    

}
