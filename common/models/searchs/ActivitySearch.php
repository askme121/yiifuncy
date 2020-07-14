<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Activity;

class ActivitySearch extends Activity
{
    public function rules()
    {
        return [
            [['id', 'type', 'status'], 'integer'],
            [['url_key'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Activity::find()->where(['site_id'=>\Yii::$app->session['default_site_id']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'url_key', $this->url_key]);

        return $dataProvider;
    }
}