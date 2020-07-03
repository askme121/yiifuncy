<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Config;

class ConfigSearch extends Config
{
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at', 'sort', 'status', 'group'], 'integer'],
            [['name', 'title', 'value', 'remark'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Config::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'sort' => $this->sort,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
