<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

class ProductSearch extends Product
{
    public function rules()
    {
        return [
            [['id', 'order', 'status', 'category_id', 'brand_id'], 'integer'],
            [['name', 'sku', 'url_key'], 'safe'],
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
        $query = Product::find()
                 ->where(['site_id'=>$site_id]);
        if ($role_id != 1){
            $query->andWhere(['team_id'=>$team_id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'sku', $this->sku])
              ->andFilterWhere(['like', 'url_key', $this->url_key]);

        return $dataProvider;
    }
}