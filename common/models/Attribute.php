<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Attribute extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product_attribute}}';
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
            [['name', 'attr_type', 'db_type', 'display_type', 'default'], 'string'],
            [['status', 'is_require', 'show_as_img', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'attr_name'),
            'attr_type'=> Yii::t('app', 'attr_type'),
            'db_type' => Yii::t('app', 'data_type'),
            'display_type' => Yii::t('app', 'display_type'),
            'default' => Yii::t('app', 'default'),
            'is_require' => Yii::t('app', 'is_require'),
            'show_as_img' => Yii::t('app', 'show_as_img'),
            'status' => Yii::t('app', 'status'),
            'role_id' => Yii::t('app', 'role'),
            'team_id' => Yii::t('app', 'team'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
        ];
    }
}