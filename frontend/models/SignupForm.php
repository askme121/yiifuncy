<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;

    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['first_name', 'string', 'min' => 2, 'max' => 255],
            ['last_name', 'string', 'min' => 2, 'max' => 255],
            ['captcha', 'captcha'],
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->username;
        $user->firstname = $this->first_name;
        $user->lastname = $this->last_name;
        $user->r_id = 1;
        $user->created_ip = Yii::$app->getRequest()->getUserIP();
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
