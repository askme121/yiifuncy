<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Activity extends ActiveRecord
{
    const STATUS_INIT  = 0;
    const STATUS_ENABLE  = 1;
    const STATUS_CANCEL = 2;
    const COUPON_ACTIVITY = 1;
    const CASHBACK_ACTIVITY = 2;
    const CASHBACK_COUPON_ACTIVITY = 3;

    public $coupon_code;
    public $form_coupon_code;

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
            [['url_key', 'amazon_url', 'asin', 'sold_by'], 'string'],
            [['type', 'status', 'qty', 'role_id', 'team_id', 'user_id', 'site_id', 'product_id', 'coupon_type'], 'integer'],
            [['price', 'cashback', 'coupon'], 'number'],
            [['form_coupon_code', 'start', 'end'], 'safe']
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
            'price' => Yii::t('app', 'price').'('.getSymbol().')',
            'cashback' => Yii::t('app', 'cashback').'('.getSymbol().')',
            'coupon' => Yii::t('app', 'coupon'),
            'start' => Yii::t('app', 'start_time'),
            'end' => Yii::t('app', 'end_time'),
            'product_id' => Yii::t('app', 'activity_product'),
            'coupon_type' => Yii::t('app', 'coupon_type'),
            'coupon_code' => Yii::t('app', 'coupon_code'),
            'form_coupon_code' => Yii::t('app', 'coupon_code'),
            'sold_by' => Yii::t('app', 'sold_by'),
        ];
    }

    public function afterFind()
    {
        $this->coupon_code = $this->getCoupon($this->id);
        parent::afterFind();
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(),['id'=>'product_id'])->select(['id','name','sku','url_key','thumb_image','image']);
    }

    public function getCoupon($activity_id)
    {
        return Coupon::find()->where(['activity_id'=>$activity_id])->asArray()->all();
    }
}