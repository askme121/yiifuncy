<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class EmailRecord extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%email_record}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function rules()
    {
        return [
            [['title', 'email', 'content', 'scene'], 'string'],
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '邮件标题',
            'email' => '邮箱地址',
            'content' => '邮件内容',
            'status' => '发送状态',
            'scene' => '发送场景',
            'created_at' => '发送时间'
        ];
    }
}