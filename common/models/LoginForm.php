<?php

namespace common\models;

use Yii;
use yii\base\Model;
use wsl\ip2location\Ip2Location;

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username'], 'email'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if ($user->status != user::STATUS_ACTIVE) {
                return false;
            } else {
                $user->last_login_date = time();
                $user->last_login_ip = Yii::$app->getRequest()->getUserIP();
                if (!empty($user->last_login_ip) && $user->last_login_ip != '127.0.0.1') {
                    $ipLocation = new Ip2Location();
                    $locationModel = $ipLocation->getLocation($user->last_login_ip);
                    $ip_info = $locationModel->toArray();
                    if (isset($ip_info['country'])) {
                        $user->last_login_address = $ip_info['country'];
                    }
                }
                $user->save();
                return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
        }
        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }
        return $this->_user;
    }
}
