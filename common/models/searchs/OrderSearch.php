<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

class OrderSearch extends Order
{
    public $start;
    public $end;

    public function rules()
    {
        return [
            [['activity_id', 'status', 'order_type'], 'integer'],
            [['order_id', 'user_email', 'product_name', 'product_sku', 'created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.site_id'=>$site_id]);
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
            'activity_id' => $this->activity_id,
            'status' => $this->status,
        ]);

        switch ($this->order_type){
            case 1:
                $query->andFilterWhere(['in', 'order_type', [1, 3]]);
                break;
            case 2:
                $query->andFilterWhere(['in', 'order_type', [2]]);
                break;
        }

        $query->andFilterWhere(['between','created_at',$this->start, $this->end])
              ->andFilterWhere(['like', 'product_name', $this->product_name])
              ->andFilterWhere(['like', 'product_sku', $this->product_sku]);

        return $dataProvider;
    }

    public function check($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.site_id'=>$site_id, 't_order.status'=>2]);
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
            'activity_id' => $this->activity_id,
        ]);

        switch ($this->order_type){
            case 1:
                $query->andFilterWhere(['in', 'order_type', [1, 3]]);
                break;
            case 2:
                $query->andFilterWhere(['in', 'order_type', [2]]);
                break;
        }

        $query->andFilterWhere(['between','created_at',$this->start, $this->end])
              ->andFilterWhere(['like', 'product_name', $this->product_name])
              ->andFilterWhere(['like', 'product_sku', $this->product_sku]);

        return $dataProvider;
    }

    public function cashback($params)
    {
        $site_id = \Yii::$app->session['default_site_id'];
        $query = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.site_id'=>$site_id, 't_order.status'=>3]);
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
            'activity_id' => $this->activity_id,
        ]);

        switch ($this->order_type){
            case 1:
                $query->andFilterWhere(['in', 'order_type', [1, 3]]);
                break;
            case 2:
                $query->andFilterWhere(['in', 'order_type', [2]]);
                break;
        }

        $query->andFilterWhere(['between','created_at',$this->start, $this->end])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_sku', $this->product_sku]);

        return $dataProvider;
    }
}