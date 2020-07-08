<?php

namespace common\models;

use Yii;
use yii\base\InvalidValueException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    const MENU_SHOW      = 1;
    const MENU_NOT_SHOW  = 2;
    const STATUS_ENABLE  = 1;
    const STATUS_DISABLE = 2;

    public static function tableName()
    {
        return '{{%category}}';
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
            [['name', 'url_key', 'description', 'title'], 'string'],
            [['order', 'status', 'parent_id', 'menu_show', 'deepth'], 'integer'],
            [['url_key'], 'unique'],
            [['title', 'meta_keywords', 'meta_description'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app', 'cate_name'),
            'url_key'=> Yii::t('app', 'url_key'),
            'description' => Yii::t('app', 'cate_description'),
            'title' => Yii::t('app', 'meta_title'),
            'meta_keywords' => Yii::t('app', 'meta_keywords'),
            'meta_description' => Yii::t('app', 'meta_description'),
            'parent_id' => Yii::t('app', 'parent'),
            'menu_show' => Yii::t('app', 'menu_show'),
            'order' => Yii::t('app', 'order'),
            'status' => Yii::t('app', 'status'),
        ];
    }

    public function beforeSave($insert)
    {
        foreach ($this->attributes() as $attr) {
            if (is_array($this->{$attr})) {
                throw new InvalidValueException('category model save fail,  attribute ['.$attr. '] is array, you must serialize it before save ');
            }
        }
        return parent::beforeSave($insert);
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
            ->where(['parent_id'=>0, 'status'=>1])
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
            ->where(['parent_id'=>$id, 'status'=>1])
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