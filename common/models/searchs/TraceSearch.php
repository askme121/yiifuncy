<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Trace;

class TraceSearch extends Trace
{
    public function rules()
    {
        return [
            [['is_new', 'first_page'], 'integer'],
            [['country_code', 'device', 'url', 'tag', 'sign'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query = Trace::find()->where(['site_id'=>$site_id]);
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

        $query->andFilterWhere([
            'is_new' => $this->is_new,
            'first_page' => $this->first_page,
            'country_code' => $this->country_code
        ]);

        $query->andFilterWhere(['like', 'device', $this->device])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like', 'sign', $this->sign])
            ->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}