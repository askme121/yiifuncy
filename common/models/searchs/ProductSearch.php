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
        $query = Product::find()->where(['site_id'=>\Yii::$app->session['default_site_id']]);
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