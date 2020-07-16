<?php

namespace rbac\models;

use Yii;
use rbac\components\Configs;
use yii\behaviors\TimestampBehavior;

class Rule extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
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
            [['name', 'rule_name', 'type', 'parent'], 'required'],
            [['is_del', 'type', 'deepth', 'parent', 'order'], 'integer'],
            [['name', 'rule_name', 'route', 'icon'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('rbac-admin', 'rule_name'),
            'rule_name' => Yii::t('rbac-admin', 'rule_sign'),
            'route' => Yii::t('rbac-admin', 'rule_route'),
            'type' => Yii::t('rbac-admin', 'rule_type'),
            'parent' => Yii::t('rbac-admin', 'rule_parent'),
            'order' => Yii::t('rbac-admin', 'Order'),
            'icon' => Yii::t('rbac-admin', 'Icon'),
        ];
    }

    public static function formatTree($is_format=false)
    {
        $options = [];
        $res = self::getTree();
        self::formatChild($res, $options, $is_format);
        return $options;
    }

    protected static function formatChild($res, &$ops, $is_format)
    {
        if ($res)
        {
            foreach ($res as $v)
            {
                if ($is_format)
                {
                    $ops[$v['id']] = str_repeat("¬¬",$v['deepth']-1).$v['name'];
                }
                else
                {
                    $ops[$v['id']] = $v['name'];
                }
                if (!empty($v['child']))
                {
                    self::formatChild($v['child'], $ops, $is_format);
                }
            }
        }
    }

    public static function getTree()
    {
        $res = self::find()
            ->where(['parent'=>0, 'is_del'=>0])
            ->orderBy('id')
            ->asArray()
            ->all();
        if ($res)
        {
            foreach ($res as &$v)
            {
                $v['child'] = self::getChild($v['id']);
            }
        }
        return $res;
    }

    protected static function getChild($id)
    {
        $res = self::find()
            ->where(['parent'=>$id, 'is_del'=>0])
            ->orderBy('id')
            ->asArray()
            ->all();
        if ($res)
        {
            foreach ($res as &$vv)
            {
                $vv['child'] = self::getChild($vv['id']);
            }
        }
        return $res;
    }
}
