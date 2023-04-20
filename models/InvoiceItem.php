<?php

namespace app\models;

use Yii;

class InvoiceItem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%invoice_item}}';
    }

    public function rules()
    {
        return [
            [['invoice_id', 'item_id', 'quantity', 'value'], 'required'],
            [['invoice_id', 'item_id', 'quantity'], 'integer'],
            [['value'], 'number'],
        ];
    }

    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }
}
