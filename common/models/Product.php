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
            [['name', 'sku', 'url_key', 'short_description', 'description', 'remark'], 'string'],
            [['order', 'score', 'status', 'long', 'width', 'high', 'brand_id', 'category_id', 'review_count', 'role_id', 'team_id', 'user_id', 'site_id', 'attr_group'], 'integer'],
            [['url_key', 'sku'], 'unique'],
            [['weight', 'volume_weight'], 'number'],
            [['meta_title', 'meta_keywords', 'meta_description', 'thumb_image', 'image', 'mutil_image', 'attr_group_info'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'product_name'),
            'sku' => Yii::t('app', 'sku'),
            'url_key'=> Yii::t('app', 'url_key'),
            'short_description' => Yii::t('app', 'short_description'),
            'description' => Yii::t('app', 'description'),
            'meta_title' => Yii::t('app', 'meta_title'),
            'meta_keywords' => Yii::t('app', 'meta_keywords'),
            'meta_description' => Yii::t('app', 'meta_description'),
            'remark' => Yii::t('app', 'remark'),
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
            'mutil_image' => Yii::t('app', 'mutil_image'),
            'attr_group' => Yii::t('app', 'attr_group'),
            'attr_group_info' => Yii::t('app', 'attr_group_info'),
        ];
    }

    public function beforeSave($insert)
    {
        if($this->mutil_image && is_array($this->mutil_image)) {
            $this->mutil_image = array_values($this->mutil_image);
            $this->mutil_image = serialize($this->mutil_image);
        }
        if($this->attr_group_info && is_array($this->attr_group_info)) {
            $this->attr_group_info = serialize($this->attr_group_info);
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->mutil_image = unserialize($this->mutil_image);
        $this->attr_group_info = unserialize($this->attr_group_info);
        parent::afterFind();
    }
}