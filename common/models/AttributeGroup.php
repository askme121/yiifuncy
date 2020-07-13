<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AttributeGroup extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%product_attribute_group}}';
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
            [['name', 'attr_ids'], 'string'],
            [['status', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'attr_group_name'),
            'attr_ids'=> Yii::t('app', 'attr_ids'),
            'status' => Yii::t('app', 'status'),
            'role_id' => Yii::t('app', 'role'),
            'team_id' => Yii::t('app', 'team'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
        ];
    }
}