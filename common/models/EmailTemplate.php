<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class EmailTemplate extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%email_template}}';
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
            [['title', 'name', 'content', 'scene'], 'string'],
            [['site_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '模板标题',
            'name' => '模板名称',
            'content' => '模板内容',
            'scene' => '发送场景',
            'created_at' => '添加时间'
        ];
    }
}