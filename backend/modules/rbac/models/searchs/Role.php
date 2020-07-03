<?php

namespace rbac\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use rbac\models\Role as RoleModel;

class Role extends RoleModel
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'pruview'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RoleModel::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
        ]);

        return $dataProvider;
    }
}