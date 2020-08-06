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
        $curr = 0;
        $select = "t_activity.id,t_activity.url_key,product_id,type,price,cashback,coupon_type,coupon,price,qty";
        $query = Activity::find()->select($select)->innerJoinWith('product')->where(['t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time]);
        if (isset($param['category']) && !empty($param['category'])){
            switch (trim($param['category']))
            {
                case 'coupon&cashback':
                    $curr = Activity::CASHBACK_COUPON_ACTIVITY;
                    $query->andWhere(['type'=>Activity::CASHBACK_COUPON_ACTIVITY]);
                    $activity_info = ActivityType::findOne(Activity::CASHBACK_COUPON_ACTIVITY);
                    $meta['title'] = $activity_info->meta_title;
                    $meta['description'] = $activity_info->meta_keywords;
                    $meta['keyword'] = $activity_info->meta_description;
                    $meta['top_title'] = 'Coupon + Cashback Deals';
                    $meta['top_desc'] = '';
                    break;
                case 'cashback':
                    $curr = Activity::CASHBACK_ACTIVITY;
                    $query->andWhere(['type'=>Activity::CASHBACK_ACTIVITY]);
                    $activity_info = ActivityType::findOne(Activity::CASHBACK_ACTIVITY);
                    $meta['title'] = $activity_info->meta_title;
                    $meta['description'] = $activity_info->meta_keywords;
                    $meta['keyword'] = $activity_info->meta_description;
                    $meta['top_title'] = 'Cashback Deals';
                    $meta['top_desc'] = 'Cashback to you paypal account.';
                    break;
                case 'coupon':
                    $curr = Activity::COUPON_ACTIVITY;
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
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '12']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        if ($model){
            foreach ($model as $kk=>$vv){
                switch ($vv['type'])
                {
                    case 1:
                        if ($vv['coupon_type'] == 1){
                            $model[$kk]['final_price'] = number_format($vv['price']*(1 - $vv['coupon']/100), 2);
                            $model[$kk]['total_off'] = $vv['coupon'];
                        } else {
                            $model[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $model[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 2);
                        }
                        break;
                    case 2:
                        $model[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $model[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $model[$kk]['final_price'] = number_format($vv['price'] * (1 - $vv['coupon']/100) - $vv['cashback'], 2);
                            $model[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        } else {
                            $model[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $model[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        }
                        break;
                    default:
                        $model[$kk]['final_price'] = 0;
                        $model[$kk]['total_off'] = 0;
                        break;
                }
            }
        }
        return $this->render('index', [
            'model' => $model,
            'pages' => $pages,
            'meta' => $meta,
            'curr' => $curr
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
            $select = "id,t_activity.url_key,product_id,type,price,cashback,coupon_type,coupon,price,qty,start,end";
            $model = Activity::find()->select($select)->where(['id'=>$activity_id,'site_id'=>$site_id])->asArray()->one();
            if ($model){
                if ($model['start'] > time()){
                    return $this->render('/site/error');
                }
                $model['product'] = Product::find()->select("id,name,sku,url_key,thumb_image,image,mutil_image,attr_group,attr_group_info,description,short_description,meta_title,meta_keywords,meta_description")->where(['id' => $model['product_id']])->asArray()->one();
                $meta['title'] = $model['product']['meta_title'];
                $meta['description'] = $model['product']['meta_description'];
                $meta['keyword'] = $model['product']['meta_keywords'];
                if ($model['type'] == 1){
                    if ($model['coupon_type'] == 1){
                        $model['final_price'] = number_format($model['price'] * (1 - $model['coupon']/100), 2);
                    } else {
                        $model['final_price'] = number_format($model['price'] - $model['coupon'], 2);
                    }
                } else if ($model['type'] == 2){
                    $model['final_price'] = number_format($model['price'] - $model['cashback'], 2);
                } else if ($model['type'] == 3){
                    if ($model['coupon_type'] == 1){
                        $model['final_price'] = number_format($model['price'] * (1 - $model['coupon']/100)-$model['cashback'], 2);
                    } else {
                        $model['final_price'] = number_format($model['price'] - $model['coupon'] - $model['cashback'], 2);
                    }
                }
                $model['save_price'] = number_format($model['price'] - $model['final_price'], 2);
                $mutil_image = unserialize($model['product']['mutil_image'])? unserialize($model['product']['mutil_image']): [];
                if (!empty($mutil_image)){
                    array_unshift($mutil_image, ['image'=>$model['product']['image'], 'thumb_image'=>$model['product']['thumb_image']]);
                    $model['product']['mutil_image'] = $mutil_image;
                } else {
                    $model['product']['mutil_image'][] = ['image'=>$model['product']['image'], 'thumb_image'=>$model['product']['thumb_image']];
                }
                return $this->render('detail', ['model' => $model, 'meta' => $meta, 'currentUrl' => $currentUrl]);
            } else {
                return $this->render('/site/error');
            }

        } else {
            return $this->render('/site/error');
        }
    }
}
