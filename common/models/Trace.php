<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Trace extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%trace}}';
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
            [['uuid', 'url'], 'required'],
            [['country_code', 'country_name', 'state_name', 'city_name', 'device', 'user_agent'], 'string'],
            [['is_new', 'first_page', 'product_id', 'activity_id'], 'integer'],
            [['browser', 'browser_version', 'browser_date', 'browser_lang', 'operate', 'operate_relase', 'domain', 'refer_url', 'first_referrer_url',
            'first_referrer_domain', 'device_pixel_ratio', 'resolution', 'color_depth', 'channel', 'tag', 'sign'
            ], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => Yii::t('app', 'ip'),
            'url' => Yii::t('app', 'url'),
            'country_code' => Yii::t('app', 'country'),
            'country_name' => Yii::t('app', 'country_name'),
            'state_name' => Yii::t('app', 'state'),
            'city_name' => Yii::t('app', 'city'),
            'device' => Yii::t('app', 'device'),
            'browser' => Yii::t('app', 'browser'),
            'operate' => Yii::t('app', 'operate'),
            'refer_url' => Yii::t('app', 'refer_url'),
            'channel' => Yii::t('app', 'channel'),
            'tag' => Yii::t('app', 'tag'),
            'sign' => Yii::t('app', 'flag'),
            'access_date' => Yii::t('app', 'access_date'),
            'created_at' => Yii::t('app', 'access_time'),
        ];
    }
}