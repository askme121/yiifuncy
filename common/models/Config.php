<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class Config extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%config}}';
    }

    public function rules()
    {
        return [
            [['value'], 'string'],
            [['created_at', 'updated_at', 'order', 'status', 'group'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 100],
            [['name'], 'unique'],
        ];
    }

	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '配置键名',
            'title' => '名称',
            'value' => '配置键值',
            'remark' => '备注',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'group' => '分组',
            'order' => '排序值',
            'status' => '状态',
        ];
    }
	
	public function beforeSave($insert)
    {
		if(parent::beforeSave($insert)){
			Yii::$app->redis->del($this->name);
			return true;
		}
	}
	
	public static function getHtmlStatus($id)
    {
		if(isset(self::findOne($id)->status) && self::findOne($id)->status==0){
			return true;
		}else{
			return false;
		}
	}
	
	public static function getConfig($name)
    {
		$config = Yii::$app->redis->get($name);
		if(!$config){
			$config = self::findOne(['name'=>$name])->value;
			Yii::$app->redis->set($name,$config);
		}
		return $config;
	}
}
