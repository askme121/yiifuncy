<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Site extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%site}}';
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
            [['name', 'code', 'lang', 'domain'], 'required'],
            [['name', 'code', 'lang', 'domain', 'icon'], 'string'],
            [['order'], 'integer'],
            [['code'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'site_name'),
            'code' => Yii::t('app', 'country_code'),
            'lang' => Yii::t('app', 'lang_code'),
            'title' => Yii::t('app', 'meta_title'),
            'domain' => Yii::t('app', 'site_domain'),
            'icon' => Yii::t('app', 'icon'),
            'order' => Yii::t('app', 'order'),
        ];
    }
}