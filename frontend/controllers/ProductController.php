<?php

namespace frontend\controllers;

use common\models\ActivityType;
use common\models\Activity;
use common\models\Config;
use common\models\Product;
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
        $meta = [];
        $currentUrl = Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        if (isset($param['url']) && !empty($param['url'])){
            $url_key = trim($param['url']);
            $activity_id = Activity::findOne(['url_key'=>$url_key])->id;
            if (empty($activity_id)){
                return $this->render('/site/error');
            }
            $select = "id,t_activity.url_key,product_id,price,cashback,coupon_type,coupon,price,qty";
            $model = Activity::find()->select($select)->where(['id'=>$activity_id,'site_id'=>$site_id])->asArray()->one();
            if ($model){
                $model['product'] = Product::find()->select("id,name,sku,url_key,thumb_image,image,meta_title,meta_keywords,meta_description")->where(['id' => $model['product_id']])->asArray()->one();
                $meta['title'] = $model['product']['meta_title'];
                $meta['description'] = $model['product']['meta_description'];
                $meta['keyword'] = $model['product']['meta_keywords'];
                return $this->render('detail', ['model' => $model, 'meta' => $meta, 'currentUrl' => $currentUrl]);
            } else {
                return $this->render('/site/error');
            }

        } else {
            return $this->render('/site/error');
        }
    }
}
