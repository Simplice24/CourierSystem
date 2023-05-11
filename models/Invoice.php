<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $invoice_id
 * @property string $customer_name
 * @property string $invoice_date
 * @property float $amount_due
 * @property string $created_at
 * @property string $updated_at
 *
 * @property InvoiceItems[] $invoiceItems
 */
class Invoice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name', 'invoice_date', 'amount_due'], 'required'],
            [['invoice_id','signed','signature_id'], 'integer'],
            [['signature_id'], 'default', 'value' => null],
            [['invoice_date', 'created_at', 'updated_at'], 'safe'],
            [['amount_due'], 'number'],
            [['signed'], 'default', 'value' =>0],
            [['customer_name'], 'string', 'max' => 255],
            [['invoice_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'invoice_id' => 'Invoice ID',
            'user_id'=>'User Id',
            'signature_id'=>'Signature Id',
            'signed'=>'Signed',
            'customer_name' => 'Customer Name',
            'invoice_date' => 'Invoice Date',
            'amount_due' => 'Amount Due',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[InvoiceItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceItems()
    {
        return $this->hasMany(InvoiceItems::class, ['invoice_id' => 'invoice_id']);
    }
}
