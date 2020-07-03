<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserRank;

class UserRankSearch extends UserRank
{
    public function rules()
    {
        return [
            [['id', 'score', 'status'], 'integer'],
            [['name'], 'safe'],
            [['discount'], 'number'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = UserRank::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'score' => $this->score,
            'discount' => $this->discount,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);
        return $dataProvider;
    }
}
