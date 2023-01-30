<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $status_id
 * @property int $status_value
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'status_value', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['status_id', 'status_value'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 60],
            [['status_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_value' => 'Status Value',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
