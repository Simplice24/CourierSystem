<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice_items".
 *
 * @property int $id
 * @property int $invoice_id
 * @property int $item_id
 * @property string $item_name
 * @property string $sender_name
 * @property string $receiver_name
 * @property float $item_value
 * @property string $departure
 * @property string $destination
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Invoice $invoice
 * @property Item $item
 */
class InvoiceItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'invoice_id', 'item_id', 'item_name', 'sender_name', 'receiver_name', 'item_value', 'departure', 'destination'], 'required'],
            [['id', 'invoice_id', 'item_id'], 'integer'],
            [['item_value'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['item_name', 'sender_name', 'receiver_name', 'departure', 'destination'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Invoice::class, 'targetAttribute' => ['invoice_id' => 'invoice_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'item_id' => 'Item ID',
            'item_name' => 'Item Name',
            'sender_name' => 'Sender Name',
            'receiver_name' => 'Receiver Name',
            'item_value' => 'Item Value',
            'departure' => 'Departure',
            'destination' => 'Destination',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Invoice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoice()
    {
        return $this->hasOne(Invoice::class, ['invoice_id' => 'invoice_id']);
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
}
