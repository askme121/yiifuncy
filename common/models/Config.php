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
            [['created_at', 'updated_at', 'order', 'status', 'group', 'site_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 100],
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
            'site_id' => '站点',
        ];
    }
	
	public function beforeSave($insert)
    {
		if(parent::beforeSave($insert)){
            $after_str = '';
            if ($this->site_id > 0)
            {
                $after_str = '_'.$this->site_id;
            }
			Yii::$app->redis->del($this->name.$after_str);
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
	
	public static function getConfig($name, $site_id=0)
    {
        $after_str = '';
        if ($site_id > 0)
        {
            $after_str = '_'.$site_id;
        }
		$config = Yii::$app->redis->get($name.$after_str);
		if (!$config)
		{
			$config = self::findOne(['name'=>$name, 'site_id'=>$site_id])->value;
			Yii::$app->redis->set($name.$after_str, $config);
		}
		return $config;
	}
}
