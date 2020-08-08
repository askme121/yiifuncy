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
        return $model->save() && $this->sendEmail(Yii::$app->params['adminEmail']);
    }
}
