<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 99;
    const STATUS_ACTIVE = 1;

    public $auth_key;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'createDateTime',
                'updatedAtAttribute' => 'updateDateTime',
                'value' => date('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['userId' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        // password_reset_token column does not exist in DB — using code-based reset instead
        return null;
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if (md5($password) == $this->password_hash) {
            return true;
        }
        // return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     * NOTE: password_reset_token column does not exist — this is a no-op.
     * Use generatePasswordResetCode() instead.
     */
    public function generatePasswordResetToken()
    {
        // No-op: password_reset_token column does not exist in DB
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        // No-op: verification_token column does not exist in DB
    }

    /**
     * Removes password reset token
     * NOTE: password_reset_token column does not exist — this is a no-op.
     */
    public function removePasswordResetToken()
    {
        // No-op: password_reset_token column does not exist in DB
    }

    /**
     * Generates a 4-digit password reset verification code.
     * Code expires in 24 hours.
     */
    public function generatePasswordResetCode()
    {
        $this->password_reset_code = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
        $this->password_reset_code_expires = time() + 86400; // 24 hours
    }

    /**
     * Finds user by email and valid password reset code.
     *
     * @param string $email
     * @param string $code
     * @return static|null
     */
    public static function findByPasswordResetCode($email, $code)
    {
        $user = static::findOne([
            'username' => $email,
            'password_reset_code' => $code,
            'status' => self::STATUS_ACTIVE,
        ]);

        if (!$user || !static::isPasswordResetCodeValid($user->password_reset_code_expires)) {
            return null;
        }

        return $user;
    }

    /**
     * Checks if the password reset code has not expired.
     *
     * @param int $expires timestamp
     * @return bool
     */
    public static function isPasswordResetCodeValid($expires)
    {
        if (empty($expires)) {
            return false;
        }
        return (int)$expires >= time();
    }

    /**
     * Removes password reset code after use.
     */
    public function removePasswordResetCode()
    {
        $this->password_reset_code = null;
        $this->password_reset_code_expires = null;
    }
}
