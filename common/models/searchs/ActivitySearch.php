<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Activity;

class ActivitySearch extends Activity
{
    public $productName;
    public $productSku;

    public function rules()
    {
        return [
            [['id', 'type', 'status'], 'integer'],
            [['url_key', 'productName', 'productSku'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return [
            'productName' => Yii::t('app', 'product_name'),
            'productSku' => Yii::t('app', 'sku'),
        ];
    }

    public function search($params)
    {
        $team_id = \Yii::$app->user->identity->team_id;
        $role_id = \Yii::$app->user->identity->role_id;
        $query = Activity::find()->with('product')->where(['site_id'=>\Yii::$app->session['default_site_id']]);
        if ($role_id == 3)
        {
            $query->andWhere(['team_id'=>$team_id]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['productName'] = [
            'asc' => ['product.name' => SORT_ASC],
            'desc' => ['product.name' => SORT_DESC],
        ];
        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'type' => $this->type,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'url_key', $this->url_key])
              ->andFilterWhere(['like', 'product.name', $this->productName])
              ->andFilterWhere(['like', 'product.sku', $this->productSku]);

        return $dataProvider;
    }
}