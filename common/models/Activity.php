<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Activity extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity}}';
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
            [['url_key', 'amazon_url'], 'string'],
            [['type', 'status', 'qty', 'role_id', 'team_id', 'user_id', 'site_id', 'product_id'], 'integer'],
            [['start', 'end'], 'datetime'],
            [['price', 'cashback', 'coupon'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_key' => Yii::t('app', 'url_key'),
            'amazon_url'=> Yii::t('app', 'amazon_url'),
            'type' => Yii::t('app', 'activity_type'),
            'status' => Yii::t('app', 'status'),
            'qty' => Yii::t('app', 'stock'),
            'role_id' => Yii::t('app', 'role'),
            'team_id' => Yii::t('app', 'team'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
            'price' => Yii::t('app', 'price'),
            'cashback' => Yii::t('app', 'cashback'),
            'coupon' => Yii::t('app', 'coupon'),
            'start' => Yii::t('app', 'start_time'),
            'end' => Yii::t('app', 'end_time'),
            'product_id' => Yii::t('app', 'activity_product'),
        ];
    }
}