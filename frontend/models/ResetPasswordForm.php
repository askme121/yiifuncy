<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

class ResetPasswordForm extends Model
{
    public $password;
    public $confirm_password;
    private $_user;

    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            ['password', 'string', 'min' => 6],
            ['confirm_password','compare','compareAttribute'=>'password','message'=>'The two passwords are inconsistent']
        ];
    }

    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
}
