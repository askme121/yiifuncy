<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%article}}';
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
            [['url_key', 'title', 'content'], 'string'],
            [['cate_id', 'status', 'order', 'user_id', 'site_id'], 'integer'],
            [['meta_title', 'meta_keywords', 'meta_description'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url_key' => Yii::t('app', 'url_key'),
            'title'=> Yii::t('app', 'title'),
            'content' => Yii::t('app', 'content'),
            'cate_id' => Yii::t('app', 'cate'),
            'status' => Yii::t('app', 'status'),
            'order' => Yii::t('app', 'order'),
            'user_id' => Yii::t('app', 'publish'),
            'site_id' => Yii::t('app', 'site'),
            'meta_title' => Yii::t('app', 'meta_title'),
            'meta_keywords' => Yii::t('app', 'meta_keywords'),
            'meta_description' => Yii::t('app', 'meta_description'),
            'created_at' => Yii::t('app', 'publish_at')
        ];
    }
}