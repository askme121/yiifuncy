<?php

namespace rbac\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\models\Log as LogModel;

class Log extends LogModel
{
    public $admin;

    public function rules()
    {
        return [
            [['route', 'admin', 'url', 'admin_email', 'ip'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = LogModel::find()->joinWith(['admin' => function ($query) {
            $userModel = new $this->userClassName;
            $query->from($userModel::tableName() . ' admin');
        }])->from(Log::tableName() . ' log');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $sort = $dataProvider->getSort();
        $sort->defaultOrder = ['created_at' => SORT_DESC];
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'lower(log.route)', strtolower($this->route)])
            ->andFilterWhere(['like', 'lower(admin.username)', $this->admin])
            ->andFilterWhere(['like', 'lower(log.admin_email)', $this->admin_email])
            ->andFilterWhere(['like', 'lower(log.ip)', $this->ip])
            ->andFilterWhere(['like', 'lower(log.url)', strtolower($this->url)]);

        return $dataProvider;
    }
}
