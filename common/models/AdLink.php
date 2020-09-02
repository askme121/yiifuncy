<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AdLink extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%ad_link}}';
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
            [['link', 'tag', 'sign', 'channel'], 'string'],
            [['link'], 'unique'],
            [['amount'], 'number'],
            [['activity_id', 'access_count', 'reg_count', 'order_count', 'trade_count'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'link' => Yii::t('app', 'ad_link'),
            'tag' => Yii::t('app', 'tag'),
            'sign' => Yii::t('app', 'flag'),
            'channel' => Yii::t('app', 'channel'),
            'amount' => Yii::t('app', 'ad_amount'),
            'access_count' => Yii::t('app', 'access_count'),
            'reg_count' => Yii::t('app', 'reg_count'),
            'order_count' => Yii::t('app', 'order_count'),
            'trade_count' => Yii::t('app', 'trade_count'),
            'created_at' => Yii::t('app', 'publish_at'),
        ];
    }
}