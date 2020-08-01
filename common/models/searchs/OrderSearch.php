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

        $query->andFilterWhere(['between','created_at',$this->start, $this->end]);

        return $dataProvider;
    }
}