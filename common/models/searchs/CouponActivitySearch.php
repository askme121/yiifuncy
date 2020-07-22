<?php

namespace common\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Activity;

class CouponActivitySearch extends Activity
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
        $query = Activity::find()->innerJoinWith(['product'=>function($query){
            $query->andFilterWhere(['like', 'name', $this->productName])
                ->andFilterWhere(['like', 'sku', $this->productSku]);
        }])->where(['type'=>Activity::COUPON_ACTIVITY,'t_activity.site_id'=>\Yii::$app->session['default_site_id']]);
        if ($role_id == 3)
        {
            $query->andWhere(['t_activity.team_id'=>$team_id]);
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
        $this->status = $this->status??4;
        switch ($this->status){
            case 0:
            case 2:
                $query->andFilterWhere([
                    't_activity.status' => $this->status
                ]);
                break;
            case 1:
                $query->andFilterWhere([
                    't_activity.status' => 1
                ]);
                $query->andFilterWhere(['>', 'start', time()]);
                break;
            case 4:
                $query->andFilterWhere([
                    't_activity.status' => 1
                ]);
                $query->andFilterWhere(['<=', 'start', time()]);
                $query->andFilterWhere(['>=', 'end', time()]);
                break;
            case 5:
                $query->andFilterWhere([
                    't_activity.status' => 1
                ]);
                $query->andFilterWhere(['<', 'end', time()]);
                break;
            default:
                break;
        }

        $query->andFilterWhere(['like', 'url_key', $this->url_key]);

        return $dataProvider;
    }
}