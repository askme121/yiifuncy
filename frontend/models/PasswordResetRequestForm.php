<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\EmailTemplate;
use yii\helpers\Html;

class PasswordResetRequestForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    public function sendEmail()
    {
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }

        $site_id = Yii::$app->params['site_id'];
        $template = EmailTemplate::find()->where(['site_id'=>$site_id, 'scene'=>'forgot_password'])->one();
        if (!$template){
            return false;
        }

        $email_content = $template->content;
        $email_title = $template->title;
        $params['user_name'] = Html::encode($user->firstname. ' '. $user->lastname);
        $params['link'] = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
        $params['expire'] = date("M/d/Y H:i:s",Yii::$app->params['user.passwordResetTokenExpire'] + time());
        return sendEmail($this->email, $email_content, $email_title, $params, 'forgot_password');
    }
}
