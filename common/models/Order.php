<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use common\models\Activity;
use common\models\Product;

class Order extends ActiveRecord
{
    public $my_first_activity;

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
            [['activity_id', 'product_id'], 'required'],
            [['order_id', 'amazon_order_id', 'amazon_url', 'user_phone', 'user_email', 'coupon_code', 'tag', 'sign'], 'string'],
            [['order_id'], 'unique'],
            [['activity_id', 'product_id', 'user_id', 'order_type', 'status', 'is_review', 'flow_id', 'site_id', 'ad_id'], 'integer'],
            [['cashback_cost', 'coupon_cost', 'origin_cost'], 'number'],
            [['my_first_activity'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => Yii::t('app', 'activity_id'),
            'order_id' => Yii::t('app', 'order_id'),
            'amazon_order_id'=> Yii::t('app', 'amazon_order_id'),
            'amazon_url' => Yii::t('app', 'amazon_url'),
            'order_type' => Yii::t('app', 'order_type'),
            'status' => Yii::t('app', 'status'),
            'user_phone' => Yii::t('app', 'user_phone'),
            'user_email' => Yii::t('app', 'user_email'),
            'coupon_code' => Yii::t('app', 'coupon_code'),
            'user_id' => Yii::t('app', 'user_paypay'),
            'product_name' => Yii::t('app', 'product_name'),
            'product_sku' => Yii::t('app', 'sku'),
            'created_at' => Yii::t('app', 'order_created_at'),
            'updated_at' => Yii::t('app', 'updated_at'),
            'origin_cost' => Yii::t('app', 'origin_price'),
            'cashback_cost' => Yii::t('app', 'cashback'),
            'coupon_cost' => Yii::t('app', 'coupon'),
        ];
    }

    public function getActivity()
    {
        return $this->hasOne(Activity::className(),['id'=>'activity_id'])->select(['id','url_key','asin','sold_by','price','cashback','coupon_type','coupon','amazon_url']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id'])->select(['id','name','sku','thumb_image','image']);
    }
}