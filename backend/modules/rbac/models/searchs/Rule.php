<?php

namespace rbac\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\models\Rule as RuleModel;

class Rule extends RuleModel
{
    public function rules()
    {
        return [
            [['id', 'parent'], 'integer'],
            [['name', 'parent', 'rule_name'], 'safe']
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RuleModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $sort = $dataProvider->getSort();
        $sort->defaultOrder = ['id' => SORT_DESC];

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent' => $this->parent,
            'type' => $this->type,
        ])->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
