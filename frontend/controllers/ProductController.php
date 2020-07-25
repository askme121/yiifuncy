<?php

namespace frontend\controllers;

use common\models\ActivityType;
use common\models\Activity;
use common\models\Config;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;

class ProductController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $param = Yii::$app->request->get();
        $site_id = Yii::$app->params['site_id'];
        $time = time();
        $meta = [];
        $select = "t_activity.id,t_activity.url_key,product_id,price,cashback,coupon_type,coupon,price,qty";
        $query = Activity::find()->select($select)->innerJoinWith('product')->where(['t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time]);
        if (isset($param['category']) && !empty($param['category'])){
            switch (trim($param['category']))
            {
                case 'coupon&cashback':
                    $query->andWhere(['type'=>Activity::CASHBACK_COUPON_ACTIVITY]);
                    $activity_info = ActivityType::findOne(Activity::CASHBACK_COUPON_ACTIVITY);
                    $meta['title'] = $activity_info->meta_title;
                    $meta['description'] = $activity_info->meta_keywords;
                    $meta['keyword'] = $activity_info->meta_description;
                    $meta['top_title'] = 'Coupon & Cashback Deals';
                    $meta['top_desc'] = '';
                    break;
                case 'cashback':
                    $query->andWhere(['type'=>Activity::CASHBACK_ACTIVITY]);
                    $activity_info = ActivityType::findOne(Activity::CASHBACK_ACTIVITY);
                    $meta['title'] = $activity_info->meta_title;
                    $meta['description'] = $activity_info->meta_keywords;
                    $meta['keyword'] = $activity_info->meta_description;
                    $meta['top_title'] = 'Cashback Deals';
                    $meta['top_desc'] = 'Cashback to you paypal account.';
                    break;
                case 'coupon':
                    $query->andWhere(['type'=>Activity::COUPON_ACTIVITY]);
                    $activity_info = ActivityType::findOne(Activity::COUPON_ACTIVITY);
                    $meta['title'] = $activity_info->meta_title;
                    $meta['description'] = $activity_info->meta_keywords;
                    $meta['keyword'] = $activity_info->meta_description;
                    $meta['top_title'] = 'Coupon Deals';
                    $meta['top_desc'] = '';
                    break;
            }
        } else {
            $meta['title'] = Config::getConfig('web_site_title', $site_id);
            $meta['description'] = Config::getConfig('web_site_description', $site_id);
            $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
            $meta['top_title'] = 'All Deals';
            $meta['top_desc'] = '';
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '4']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'meta' => $meta
        ]);
    }

    public function actionDetail()
    {
        $param = Yii::$app->request->get();
        $site_id = Yii::$app->params['site_id'];
        $time = time();
        $meta = [];
        if (isset($param['url']) && !empty($param['url'])){
            return $this->render('detail');
        } else {
            return $this->render('/site/error', ['name'=>'error', 'message'=>'Sorry, we can\'t find the page you were trying to reach.']);
        }
    }
}
