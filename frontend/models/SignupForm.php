<?php

namespace frontend\models;

use common\models\EmailTemplate;
use Yii;
use yii\base\Model;
use common\models\User;
use yii\helpers\Html;

class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $password;
    public $captcha;
    public $is_subscribed;
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
            [['is_subscribed', 'rememberMe'], 'safe']
        ];
    }

    public function signup()
    {
        $site_id = Yii::$app->params['site_id'];
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->username;
        $user->firstname = $this->first_name;
        $user->lastname = $this->last_name;
        $user->r_id = 1;
        $user->is_subscribed = $this->is_subscribed;
        $user->created_ip = Yii::$app->getRequest()->getUserIP();
        $user->status = User::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        $template = EmailTemplate::find()->where(['site_id'=>$site_id, 'scene'=>'register'])->one();
        if (!$template){
            return false;
        }

        $email_content = $template->content;
        $email_title = $template->title;
        $params['user_name'] = Html::encode($this->first_name. ' '. $this->last_name);
        sendEmail($this->username, $email_content, $email_title, $params);
        return $user->save() && Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
}
