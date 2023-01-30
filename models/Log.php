<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $log_id
 * @property string $field_name
 * @property string $old_value
 * @property string $new_value
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property int $item_id
 *
 * @property Item $item
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_id', 'field_name', 'old_value', 'new_value', 'created_at', 'created_by', 'updated_at', 'updated_by', 'item_id'], 'required'],
            [['log_id', 'item_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['field_name', 'old_value', 'new_value', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['item_id'], 'unique'],
            [['log_id'], 'unique'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::class, 'targetAttribute' => ['item_id' => 'item_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'field_name' => 'Field Name',
            'old_value' => 'Old Value',
            'new_value' => 'New Value',
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
}
