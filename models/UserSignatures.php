<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_signatures".
 *
 * @property int $signature_id
 * @property string $signature_name
 * @property int $user_id
 * @property string|null $signature_image
 * @property string $timestamp
 *
 * @property User $user
 */
class UserSignatures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_signatures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['signature_name', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['signature_name'], 'string', 'max' => 225],
            [['signature_image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'signature_id' => 'Signature ID',
            'signature_name' => 'Signature Name',
            'user_id' => 'User ID',
            'signature_image' => 'Signature Image',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
