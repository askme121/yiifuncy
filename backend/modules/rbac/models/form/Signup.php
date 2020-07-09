<?php

namespace rbac\models\form;

use Yii;
use backend\models\Admin;
use yii\base\Model;

class Signup extends Model
{
    public $username;
	public $nickname;
	public $head_pic;
    public $email;
    public $password;
    public $role_id;
    public $team_id;

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
			['nickname', 'string', 'max' => 32],
            ['username', 'unique', 'targetClass' => 'backend\models\Admin', 'message' => 'This username has already been taken.'],
            [['username','head_pic'], 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'backend\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['role_id', 'required'],
            ['team_id', 'required'],
        ];
    }

    public function signup()
    {
        if ($this->validate()) {
            $user = new Admin();
            $user->username = $this->username;
			$user->nickname = $this->nickname;
			$user->head_pic = $this->head_pic;
            $user->role_id = $this->role_id;
            $user->team_id = $this->team_id;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
    }
	
    public function attributeLabels()
    {
        return [
			'nickname' => '用户昵称',
            'username' => '用户名',
			'head_pic' => '用户头像',
            'email' => '电子邮箱',
			'password' => '用户密码',
            'role_id' => '角色',
            'team_id' => '团队'
        ];
    }
}
