<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manifest".
 *
 * @property int $manifest_id
 * @property string $departure_date
 * @property string $departure_time
 * @property string $plate_number
 * @property string $driver
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property Item[] $items
 */
class Manifest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manifest';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departure_date', 'departure_time', 'plate_number', 'driver', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['departure_date', 'departure_time', 'created_at', 'updated_at'], 'safe'],
            [['plate_number'], 'string', 'max' => 15],
            [['driver', 'created_by', 'updated_by'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'manifest_id' => 'Manifest ID',
            'departure_date' => 'Departure Date',
            'departure_time' => 'Departure Time',
            'plate_number' => 'Plate Number',
            'driver' => 'Driver',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::class, ['manifest_id' => 'manifest_id']);
    }
}
