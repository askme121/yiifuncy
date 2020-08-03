<?php

namespace common\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%country}}';
    }

    public function rules()
    {
        return [
            [['name', 'code'], 'string'],
            [['name'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'code' => '简码',
        ];
    }
}