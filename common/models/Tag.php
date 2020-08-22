<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Tag extends ActiveRecord
{
    const STATUS_ENABLE  = 1;
    const STATUS_DISABLE = 2;

    public static function tableName()
    {
        return '{{%tag}}';
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
            [['tag', 'flag', 'channel'], 'required'],
            [['tag', 'flag', 'channel'], 'string'],
            [['status', 'role_id', 'team_id', 'user_id', 'site_id'], 'integer'],
            [['tag'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag' => Yii::t('app', 'tag'),
            'flag' => Yii::t('app', 'tag'),
            'channel' => Yii::t('app', 'channel'),
            'status' => Yii::t('app', 'status'),
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}