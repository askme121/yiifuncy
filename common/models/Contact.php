<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class Contact extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%contact}}';
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
            [['name', 'title', 'content', 'email', 'ip'], 'string'],
            [['user_id', 'order_id', 'status', 'type', 'parent'], 'integer'],
            ['email', 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'title' => '主题',
            'email' => '邮箱',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'user_id' => '用户',
            'status' => '状态',
            'type' => '类型',
            'parent' => '父级',
            'order_id' => '订单号',
            'ip' => 'Ip'
        ];
    }
}