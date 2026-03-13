<?php

namespace frontend\models;

use yii\base\Model;
use Yii;
use common\models\User;

/**
 * Reset password using a 4-digit verification code.
 * Alternative to the token-based reset link.
 */
class ResetPasswordByCodeForm extends Model
{
    public $email;
    public $code;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'code', 'password'], 'required'],
            ['email', 'email'],
            ['code', 'string', 'length' => 4],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            ['code', 'validateCode'],
        ];
    }

    /**
     * Validates the verification code against the database.
     */
    public function validateCode($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findByPasswordResetCode($this->email, $this->code);
            if (!$user) {
                $this->addError($attribute, 'Invalid or expired verification code.');
            }
        }
    }

    /**
     * Resets the password using the verification code.
     *
     * @return bool
     */
    public function resetPassword()
    {
        $user = User::findByPasswordResetCode($this->email, $this->code);
        if (!$user) {
            return false;
        }

        // Use MD5 for consistency with existing password system
        $user->password_hash = md5($this->password);
        $user->removePasswordResetCode();
        $user->removePasswordResetToken();

        return $user->save(false);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'code' => Yii::t('app', 'Verification Code'),
            'password' => Yii::t('app', 'New Password'),
        ];
    }
}
