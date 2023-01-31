<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $user_fullname
 * @property string $email
 * @property string $telephone
 * @property string $password
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property int $role
 * @property int $branch_id
 *
 * @property Branch $branch
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
// class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'Simplice',
            'password' => 'CourierTesting',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_fullname', 'email', 'telephone', 'password', 'created_at', 'created_by', 'updated_at', 'updated_by', 'role', 'branch_id'], 'required'],
            [['branch_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_fullname', 'created_by', 'updated_by'], 'string', 'max' => 60],
            [['email', 'password'], 'string', 'max' => 40],
            [['telephone'], 'string', 'max' => 15],
            [['role'], 'string'],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branch_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'user_id' => 'ID',
            'user_fullname' => 'Full name',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'password' => 'Password',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'role' => 'Role',
            'branch_id' => 'Branch ID',
        ];
    }

    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function setPassword($password)
{
    $this->password = Yii::$app->security->generatePasswordHash($password);
}

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }



    /**
     * Gets query for [[Branch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::class, ['branch_id' => 'branch_id']);
    }
}
