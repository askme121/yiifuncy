<?php

namespace common\models;

use Yii;
use yii\base\InvalidValueException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Coupon extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product_coupon}}';
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
            [['coupon_code', 'product_sku'], 'string'],
            [['product_id', 'coupon_type', 'customer_id', 'status', 'order_id', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
            [['coupon'], 'number'],
            [['coupon_code'], 'unique'],
            [['expired_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_code' => Yii::t('app', 'coupon_code'),
            'product_id'=> Yii::t('app', 'product'),
            'product_sku'=> Yii::t('app', 'sku'),
            'coupon_type' => Yii::t('app', 'coupon_type'),
            'customer_id' => Yii::t('app', 'customer'),
            'order_id' => Yii::t('app', 'order_id'),
            'status' => Yii::t('app', 'status'),
            'role_id' => Yii::t('app', 'role'),
            'team_id' => Yii::t('app', 'team'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
            'coupon' => Yii::t('app', 'coupon'),
            'expired_at' => Yii::t('app', 'expired_at'),
        ];
    }
}