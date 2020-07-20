<?php

namespace common\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Coupon;

class CouponSearch extends Coupon
{
    public function rules()
    {
        return [
            [['id', 'product_id', 'status'], 'integer'],
            [['coupon_code', 'product_sku'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Coupon::find()
            ->where(['site_id'=>\Yii::$app->session['default_site_id']]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'product_sku', $this->product_sku])
            ->andFilterWhere(['like', 'coupon_code', $this->coupon_code]);

        return $dataProvider;
    }
}