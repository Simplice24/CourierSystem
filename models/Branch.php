<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $branch_id
 * @property string $branch_name
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property User[] $users
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_name', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['branch_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['branch_name', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['branch_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'branch_id' => 'Branch ID',
            'branch_name' => 'Branch Name',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['branch_id' => 'branch_id']);
    }
}
