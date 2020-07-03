<?php

namespace rbac\models\form;

use Yii;
use backend\models\Admin;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequest extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => 'rbac\models\User',
                'filter' => ['status' => Admin::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        $user = Admin::findOne([
            'status' => Admin::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!Admin::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                return Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Password reset for ' . Yii::$app->name)
                    ->send();
            }
        }
        return false;
    }
}
