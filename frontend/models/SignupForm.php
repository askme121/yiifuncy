<?php

namespace frontend\models;

use backend\models\Admin;
use common\models\AdLink;
use common\models\EmailTemplate;
use wsl\ip2location\Ip2Location;
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
    public $my_first_activity;
    public $tag;
    public $sign;

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
            [['is_subscribed', 'rememberMe', 'tag', 'sign', 'my_first_activity'], 'safe']
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
        $user->site_id = $site_id;
        $user->is_subscribed = $this->is_subscribed;
        if (!empty($this->tag)){
            $user->tag = $this->tag;
            $flag_arr = explode("-", $this->tag);
            $flag = end($flag_arr);
            if ($flag == 'fb'){
                $user->channel = 'facebook';
            } else if ($flag == 'tw'){
                $user->channel = 'twitter';
            } else {
                $user->channel = '';
            }
        }
        if (!empty($this->sign)){
            $user->sign = $this->sign;
            $user->flow_id = Admin::findOne(['sign'=>$this->sign])->id??0;
        }
        $user->created_ip = Yii::$app->getRequest()->getUserIP();
        if (!empty($user->created_ip) && $user->created_ip != '127.0.0.1') {
            $ipLocation = new Ip2Location();
            $locationModel = $ipLocation->getLocation($user->created_ip);
            $ip_info = $locationModel->toArray();
            if (isset($ip_info['country'])) {
                $user->created_address = $ip_info['country'];
            }
        }
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
        sendEmail($this->username, $email_content, $email_title, $params, 'register');
        if ($this->my_first_activity && $this->tag && $this->sign) {
            $ad = AdLink::find(['activity_id'=>$this->my_first_activity, 'tag'=>$this->tag, 'sign'=>$this->sign, 'site_id'=>$site_id])->one();
            if ($ad) {
                $ad->reg_count += 1;
                $ad->save();
                $user->ad_id = $ad->id;
            }
        }
        return $user->save() && Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }
}
