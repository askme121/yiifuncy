<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Tag;

class TagSearch extends Tag
{
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['tag', 'channel'], 'string'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $team_id = \Yii::$app->user->identity->team_id;
        $role_id = \Yii::$app->user->identity->role_id;
        $query = Tag::find()->where(['site_id'=>$site_id]);
        if ($role_id != 1){
            $query->andWhere(['team_id'=>$team_id]);
        }
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
            'status' => $this->status,
            'channel' => $this->channel,
        ]);

        $query->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}