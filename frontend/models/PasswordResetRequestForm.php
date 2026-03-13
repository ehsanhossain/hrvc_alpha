<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form.
 * Generates a 4-digit verification code and sends it via email.
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * Sends an email with a verification code.
     *
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'username' => $this->email,
        ]);

        if (!$user) {
            return false;
        }

        // Generate 4-digit verification code
        $user->generatePasswordResetCode();

        if (!$user->save(false)) {
            return false;
        }

        $resetCode = $user->password_reset_code;

        // Build a code-based reset link as well
        $resetLink = Yii::$app->urlManager->createAbsoluteUrl([
            'site/reset-password-by-code',
            'email' => $this->email,
        ]);

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                [
                    'user' => $user,
                    'resetLink' => $resetLink,
                    'resetCode' => $resetCode,
                ]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($this->email)
            ->setSubject('Reset Your HRVC Password')
            ->send();
    }
}
