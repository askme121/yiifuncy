<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Attribute extends ActiveRecord
{
    const STATUS_ENABLE  = 1;
    const STATUS_DISABLE = 2;

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
            [['display_data'], 'safe'],
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
            'display_data' => Yii::t('app', 'display_data'),
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

    public function beforeSave($insert)
    {
        if($this->display_data && is_array($this->display_data)) {
            $this->display_data = serialize($this->display_data);
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->display_data = unserialize($this->display_data);
        parent::afterFind();
    }

    public static function getList()
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $res = self::find()
            ->where(['status'=>1, 'site_id'=>$site_id])
            ->asArray()
            ->all();
        return $res;
    }
}