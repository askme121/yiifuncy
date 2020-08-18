<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $order_id;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    protected function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }

    public function doSubmit()
    {
        $model = new Contact();
        $model->name = $this->name;
        $model->title = $this->subject;
        $model->email = $this->email;
        $model->content = $this->body;
        $model->type = 1;
        $model->site_id = Yii::$app->params['site_id'];
        $model->order_id = $this->order_id;
        $model->ip = Yii::$app->getRequest()->getUserIP();
        if (!Yii::$app->user->isGuest){
            $model->user_id = Yii::$app->user->identity->id;
        }
        $res = $model->save();
        if ($res){
            $this->sendEmail(Yii::$app->params['adminEmail']);
            return true;
        } else {
            $error = $model->firstErrors;
            return $error;
        }
    }
}
