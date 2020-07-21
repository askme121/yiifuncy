<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Coupon extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%activity_coupon}}';
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
            [['coupon_code'], 'string'],
            [['activity_id', 'customer_id', 'status', 'order_id'], 'integer'],
            [['coupon_code'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_code' => Yii::t('app', 'coupon_code'),
            'activity_id'=> Yii::t('app', 'product'),
            'customer_id' => Yii::t('app', 'customer'),
            'order_id' => Yii::t('app', 'order_id'),
            'status' => Yii::t('app', 'status'),
        ];
    }
}