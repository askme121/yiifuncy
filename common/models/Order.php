<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%order}}';
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
            [['order_id', 'amazon_order_id', 'amazon_url', 'user_phone', 'user_email', 'coupon_code'], 'string'],
            [['order_id'], 'unique'],
            [['activity_id', 'product_id', 'user_id', 'order_type', 'status', 'flow_id'], 'integer'],
            [['cashback_cost', 'coupon_cost', 'origin_cost'], 'number']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => Yii::t('app', 'order_id'),
            'amazon_order_id'=> Yii::t('app', 'amazon_order_id'),
            'amazon_url' => Yii::t('app', 'amazon_url'),
            'order_type' => Yii::t('app', 'order_type'),
            'status' => Yii::t('app', 'status'),
            'user_phone' => Yii::t('app', 'user_phone'),
            'user_email' => Yii::t('app', 'user_email'),
            'coupon_code' => Yii::t('app', 'coupon_code'),
            'user_id' => Yii::t('app', 'user_id')
        ];
    }
}