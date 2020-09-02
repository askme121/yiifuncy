<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AdLink;

class AdLinkSearch extends AdLink
{
    public function rules()
    {
        return [
            [['link', 'channel'], 'string'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query = AdLink::find()
            ->where(['site_id'=>$site_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'channel', $this->channel]);

        return $dataProvider;
    }
}