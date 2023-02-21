<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $log_id
 * @property string $done_by
 * @property string $comment
 * @property int $done_at
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
            [['done_by', 'comment', 'done_at'], 'required'],
            [['done_at'], 'integer'],
            [['done_by'], 'string', 'max' => 60],
            [['comment'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'done_by' => 'Done By',
            'comment' => 'Comment',
            'done_at' => 'Done At',
        ];
    }
}
