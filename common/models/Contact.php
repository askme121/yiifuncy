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
            [['name', 'title', 'content', 'email'], 'string'],
            [['user_id', 'order_id'], 'integer'],
            ['email', 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '配置键名',
            'title' => '名称',
            'email' => '配置键值',
            'content' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'user_id' => '用户',
            'order_id' => '订单',
        ];
    }
}