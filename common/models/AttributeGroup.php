<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AttributeGroup extends ActiveRecord
{
    const STATUS_ENABLE  = 1;
    const STATUS_DISABLE = 2;

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
            [['name'], 'string'],
            [['status', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
            [['attr_ids'], 'safe'],
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

    public function beforeSave($insert)
    {
        if($this->attr_ids && is_array($this->attr_ids)) {
            $this->attr_ids = serialize($this->attr_ids);
        }
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->attr_ids = unserialize($this->attr_ids);
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

    public static function formatList()
    {
        $options = [];
        $res = self::getList();
        if ($res)
        {
            foreach ($res as $v)
            {
                $options[$v['id']] = $v['name'];
            }
        }
        return $options;
    }
}