<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Team extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%admin_team}}';
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
            ['name', 'string', 'max' => 64],
            ['order', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '团队名',
            'created_at'=>'创建时间',
            'updated_at'=>'修改时间',
            'order'=>'排序',
        ];
    }

    public static function getList()
    {
        $res = self::find()
            ->asArray()
            ->all();
        return $res;
    }
}