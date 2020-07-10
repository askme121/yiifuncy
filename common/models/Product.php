<?php

namespace common\models;

use Yii;
use yii\base\InvalidValueException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static $_customProductAttrs;
    public $category;
    const STATUS_ENABLE  = 1;
    const STATUS_DISABLE = 2;
    const IS_IN_STOCK = 1;
    const OUT_STOCK = 2;

    public static function tableName()
    {
        return '{{%product}}';
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
            [['name', 'sku', 'url_key', 'short_description', 'description', 'remark', 'amazon_url'], 'string'],
            [['order', 'score', 'status', 'long', 'width', 'high', 'brand_id', 'category_id', 'review_count', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
            [['url_key', 'sku'], 'unique'],
            [['weight', 'volume_weight'], 'number'],
            [['meta_title', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'product_name'),
            'sku' => Yii::t('app', 'sku'),
            'url_key'=> Yii::t('app', 'url_key'),
            'shot_description' => Yii::t('app', 'shot_description'),
            'description' => Yii::t('app', 'description'),
            'meta_title' => Yii::t('app', 'meta_title'),
            'meta_keywords' => Yii::t('app', 'meta_keywords'),
            'meta_description' => Yii::t('app', 'meta_description'),
            'remark' => Yii::t('app', 'remark'),
            'amazon_url' => Yii::t('app', 'amazon_url'),
            'brand_id' => Yii::t('app', 'brand'),
            'category_id' => Yii::t('app', 'cate'),
            'score' => Yii::t('app', 'score'),
            'order' => Yii::t('app', 'order'),
            'status' => Yii::t('app', 'status'),
            'team_id' => Yii::t('app', 'team'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
            'long' => Yii::t('app', 'long'),
            'width' => Yii::t('app', 'width'),
            'high' => Yii::t('app', 'height'),
            'weight' => Yii::t('app', 'weight'),
            'volume_weight' => Yii::t('app', 'volume_weight'),
            'image' => Yii::t('app', 'image'),
            'thumb_image' => Yii::t('app', 'thumb_image'),
        ];
    }

    public function beforeSave($insert)
    {
        foreach ($this->attributes() as $attr) {
            if (is_array($this->{$attr})) {
                throw new InvalidValueException('product model save fail,  attribute ['.$attr. '] is array, you must serialize it before save ');
            }
        }
        return parent::beforeSave($insert);
    }

    public function addCustomProductAttrs($attrs)
    {
        self::$_customProductAttrs = $attrs;
    }
}