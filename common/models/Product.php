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