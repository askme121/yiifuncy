<?php

namespace rbac\models;

use Yii;
use rbac\components\Configs;
use yii\behaviors\TimestampBehavior;

class Role extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_role}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert)
    {
        if($this->purview) {
            $this->purview = implode(',',$this->purview);
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->purview = explode(',',$this->purview);
        parent::afterFind();
    }

    public static function getDb()
    {
        if (Configs::instance()->db !== null) {
            return Configs::instance()->db;
        } else {
            return parent::getDb();
        }
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['order'], 'integer'],
            [['desc'], 'string'],
            [['purview'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'name' => Yii::t('rbac-admin', 'role_name'),
            'desc' => Yii::t('rbac-admin', 'Description'),
            'purview' => Yii::t('rbac-admin', 'Permission'),
            'order' => Yii::t('rbac-admin', 'Order'),
            'created_at' => Yii::t('rbac-admin', 'Create_at'),
            'updated_at' => Yii::t('rbac-admin', 'Update_at'),
        ];
    }

    public static function getList()
    {
        $res = self::find()
            ->asArray()
            ->all();
        return $res;
    }
}