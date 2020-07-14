<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class ActivityType extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_type}}';
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
            [['name'], 'string'],
            [['meta_title', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'cate_name'),
            'meta_title' => Yii::t('app', 'meta_title'),
            'meta_keywords' => Yii::t('app', 'meta_keywords'),
            'meta_description' => Yii::t('app', 'meta_description'),
        ];
    }

    public static function getList()
    {
        $res = self::find()
            ->asArray()
            ->all();
        return $res;
    }

    public static function formatList()
    {
        $options = [];
        $res = self::getList();
        if ($res)
        {
            foreach ($res as $v)
            {
                $options[$v['id']] = $v['name'];
            }
        }
        return $options;
    }
}