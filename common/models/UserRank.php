<?php

namespace common\models;

use yii\helpers\ArrayHelper;

class UserRank extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_rank}}';
    }

    public function rules()
    {
        return [
            [['name', 'score', 'discount', 'status'], 'required'],
            [['score', 'status'], 'integer'],
            [['discount'], 'number'],
            [['name'], 'string', 'max' => 30],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '等级名称',
            'score' => '分值',
            'discount' => '折扣',
            'status' => '状态',
        ];
    }

	public static function dropDown()
    {
		$data = self::find()->asArray()->all();
		$data_list = ArrayHelper::map($data, 'id', 'name');
		return $data_list;
	}

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['r_id' => 'id']);
    }
}
