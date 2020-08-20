<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Contact;

class MessageForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $order_id = 0;
    public $parent = 0;

    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            ['email', 'email'],
            [['parent', 'order_id'], 'integer'],
        ];
    }

    protected function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
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
        if ($this->parent > 0) {
            $info = Contact::findOne($this->parent);
            $model->order_id = $info->order_id;
            $model->parent = $this->parent;
        }
        $model->ip = Yii::$app->getRequest()->getUserIP();
        if (!Yii::$app->user->isGuest){
            $model->user_id = Yii::$app->user->identity->id;
        }
        $res = $model->save();
        if ($res){
            if (isset($info) && !empty($info)) {
                $info->status = 2;
                $info->save();
            }
            $this->sendEmail(Yii::$app->params['adminEmail']);
            return true;
        } else {
            $error = $model->firstErrors;
            return $error;
        }
    }
}