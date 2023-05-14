<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $user_fullname
 * @property string $username
 * @property string $profile
 * @property string $role
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property string $telephone
 * @property int $branche_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property Branch $branche
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_fullname', 'username','profile', 'role', 'auth_key', 'password_hash', 'email', 'telephone', 'branche_id', 'created_at', 'updated_at'], 'required'],
            [['branche_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['profile'], 'string', 'max' => 255],
            [['user_fullname'], 'string', 'max' => 224],
            [['username','profile', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 40],
            [['auth_key'], 'string', 'max' => 32],
            [['telephone'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['branche_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::class, 'targetAttribute' => ['branche_id' => 'branch_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            // 'id' => 'ID',
            'user_fullname' => 'Full name',
            'username' => 'Username',
            'profile' => 'Profile',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'branche_id' => 'Branche ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[Branche]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBranche()
    {
        return $this->hasOne(Branch::class, ['branch_id' => 'branche_id']);
    }

     
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function setPassword($password)
    {
      $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    public static function findByUsername($username)
    {
        // foreach (self::$users as $user) {
        //     if (strcasecmp($user['username'], $username) === 0) {
        //         return new static($user);
        //     }
        // }

        // return null;

        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password,$this->password_hash);
    }

}
