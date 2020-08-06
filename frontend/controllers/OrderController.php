<?php

namespace frontend\controllers;

use common\models\Activity;
use common\models\Coupon;
use common\models\Product;
use common\models\User;
use common\models\Config;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Order;
use Yii;

class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    ['allow' => true, 'actions' => [], 'verbs' => ['GET']],
                    ['allow' => true, 'actions' => ['deal', 'submit', 'uporder', 'give-up'], 'verbs' => ['POST']],
                ],
            ],
        ];
    }

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
        $site_id = Yii::$app->params['site_id'];
        $user_id = Yii::$app->user->identity->getId();
        $currentUrl = Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $query = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.site_id'=>$site_id, 't_order.user_id'=>$user_id, 'order_type'=>2]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '12']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('index', ['meta'=>$meta, 'model'=>$model, 'pages'=>$pages, 'currentUrl'=>$currentUrl]);
    }

    public function actionView($id)
    {
        $site_id = Yii::$app->params['site_id'];
        $user_id = Yii::$app->user->identity->getId();
        $currentUrl = Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $model = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.id'=>$id, 't_order.site_id'=>$site_id, 't_order.user_id'=>$user_id])
            ->asArray()->one();
        return $this->render('view', ['meta'=>$meta, 'order'=>$model, 'currentUrl'=>$currentUrl]);
    }

    public function actionCoupon()
    {
        $site_id = Yii::$app->params['site_id'];
        $user_id = Yii::$app->user->identity->getId();
        $currentUrl = Yii::$app->request->hostInfo.Yii::$app->request->getUrl();
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $query = Order::find()
            ->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.site_id'=>$site_id, 't_order.user_id'=>$user_id]);
        $query->andWhere(['in', 'order_type', [1,3]]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '12']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->asArray()->all();
        return $this->render('coupon', ['meta'=>$meta, 'model'=>$model, 'pages'=>$pages, 'currentUrl'=>$currentUrl]);
    }

    public function actionUporder($id)
    {
        if (empty($id)){
            return json_encode([
                'code' => 208,
                'status' => 0,
                'message' => 'The request is illegal',
            ]);
        }
        if (Yii::$app->user->isGuest){
            return json_encode([
                'code' => 202,
                'status' => 0,
                'message' => 'please login in',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
        $param = Yii::$app->request->post();
        if (!isset($param['amz_order_id']) || !trim($param['amz_order_id'])){
            return json_encode([
                'code' => 201,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $amz_order_id = trim($param['amz_order_id']);
        $model = Order::findOne($id);
        if (!$model){
            return json_encode([
                'code' => 203,
                'status' => 0,
                'message' => 'The deals is not exist'
            ]);
        }
        if ($model->user_id != $user_id){
            return json_encode([
                'code' => 204,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $user = User::findOne($user_id);
        if (empty($user->amazon_profile_url) || empty($user->paypal_account)){
            return json_encode([
                'code' => 205,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $res = Order::find()->where(['amazon_order_id'=>$amz_order_id])->one();
        if ($res){
            return json_encode([
                'code' => 209,
                'status' => 0,
                'message' => 'Other order has already submitted this order ID'
            ]);
        }
        $model->amazon_order_id = $amz_order_id;
        $model->status = 2;
        if ($model->save()){
            return json_encode([
                'code' => 1,
                'status' => 2,
                'message' => 'successful'
            ]);
        } else {
            $error = $model->firstErrors;
            return json_encode([
                'code' => 207,
                'status' => 0,
                'message' => array_values($error)
            ]);
        }
    }

    public function actionGiveUp($id)
    {
        if (empty($id)){
            return json_encode([
                'code' => 208,
                'status' => 0,
                'message' => 'The request is illegal',
            ]);
        }
        if (Yii::$app->user->isGuest){
            return json_encode([
                'code' => 202,
                'status' => 0,
                'message' => 'please login in',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
        $model = Order::findOne($id);
        if (!$model){
            return json_encode([
                'code' => 203,
                'status' => 0,
                'message' => 'The deals is not exist'
            ]);
        }
        if ($model->user_id != $user_id){
            return json_encode([
                'code' => 204,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        if ($model->status >= 4){
            return json_encode([
                'code' => 205,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $model->status = 6;
        if ($model->save()){
            return json_encode([
                'code' => 1,
                'status' => 2,
                'message' => 'successful'
            ]);
        } else {
            $error = $model->firstErrors;
            return json_encode([
                'code' => 207,
                'status' => 0,
                'message' => array_values($error)
            ]);
        }
    }

    public function actionDeal()
    {
        if (Yii::$app->user->isGuest){
            return json_encode([
                'code' => 202,
                'status' => 0,
                'message' => 'please login in',
            ]);
        }
        $expire_day = Yii::$app->params['order.Expire'];
        $user_id = Yii::$app->user->identity->getId();
        $user = User::findOne($user_id);
        $model = new Order();
        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate()){
                $activity_id = $model->activity_id;
                $product_id = $model->product_id;
                $activity = Activity::findOne($activity_id);
                $product = Product::findOne($product_id);
                if ($activity->start > time() || $activity->end < time() || $activity->status != 1){
                    return json_encode([
                        'code' => 1,
                        'status' => 0,
                        'message' => 'Activity is out of validity'
                    ]);
                }
                if ($activity->qty <= 0){
                    return json_encode([
                        'code' => 1,
                        'status' => 3,
                        'message' => 'Sold Out'
                    ]);
                }
                $cashback_order = Order::find()->where(['user_id'=>$user_id, 'order_type'=>2, 'product_id'=>$product_id])->andWhere(['!=', 'status', 1])->andWhere(['<=', 'status', 4])->all();
                if ($cashback_order){
                    return json_encode([
                        'code' => 1,
                        'status' => 4,
                        'message' => 'you have unfinished deals',
                        'deals_url' => '/account/deal'
                    ]);
                }
                $hover_order = Order::find()->where(['user_id'=>$user_id])->andWhere(['<>', 'activity_id', $activity_id])->andWhere(['>', 'created_at', time()-$expire_day*24*3600])->andWhere(['<', 'status', 4])->all();
                if ($hover_order){
                    return json_encode([
                        'code' => 1,
                        'status' => 7,
                        'message' => 'you have unfinished deals',
                        'deals_url' => '/account/deal'
                    ]);
                }
                $curr_order = Order::find()->where(['user_id'=>$user_id, 'activity_id'=>$activity_id])->andWhere(['>', 'created_at', time()-$expire_day*24*3600])->andWhere(['=', 'status', 1])->one();
                if ($curr_order){
                    if ($curr_order->order_type == 2){
                        $starus = 1;
                    } else {
                        $starus = 2;
                    }
                    return json_encode([
                        'code' => 1,
                        'status' => $starus,
                        'message' => 'you have unfinished deals',
                        'coupon_code' => $curr_order->coupon_code,
                        'link' => $curr_order->amazon_url,
                        'order_id' => $curr_order->id
                    ]);
                }
                $unover_order = Order::find()->where(['user_id'=>$user_id, 'activity_id'=>$activity_id])->andWhere(['>', 'created_at', time()-$expire_day*24*3600])->andWhere(['>', 'status', 1])->andWhere(['<', 'status', 4]);
                if ($unover_order){
                    if ($curr_order->order_type == 2){
                        $deals_url = '/account/deal';
                    } else {
                        $deals_url = '/account/coupon';
                    }
                    return json_encode([
                        'code' => 1,
                        'status' => 6,
                        'message' => 'you have unfinished deals',
                        'deals_url' => $deals_url
                    ]);
                }
                $review_order = Order::find()->innerJoinWith('activity')->innerJoinWith('product')->where(['t_order.user_id'=>$user_id, 't_order.status'=>4, 'is_review'=>0])->one();
                if ($review_order){
                    return json_encode([
                        'code' => 1,
                        'status' => 8,
                        'message' => 'you have unfinished deals',
                        'amazon_url' => 'https://www.amazon.com/review/review-your-purchases/?asin='.$review_order->activity->asin,
                        'product_name' => $review_order->product->name,
                        'product_image' => $review_order->product->thumb_image,
                    ]);
                }
                $model->order_id = getOrderID();
                $model->user_id = $user_id;
                $model->order_type = $activity->type;
                $model->status = 1;
                $model->amazon_url = $activity->amazon_url;
                $model->user_email = $user->email;
                $model->origin_cost = $activity->price;
                $model->cashback_cost = $activity->cashback;
                $model->product_sku = $product->sku;
                $model->product_name = $product->name;
                $model->deals_ip = Yii::$app->getRequest()->getUserIP();
                $model->site_id = Yii::$app->params['site_id'];
                if ($activity->type == 2){
                    $activity->qty = $activity->qty-1;
                    $activity->save();
                    $order_id = $model->save();
                    if ($order_id){
                        return json_encode([
                            'code' => 1,
                            'status' => 1,
                            'message' => 'successful',
                            'link' => $activity->amazon_url,
                            'order_id' => $model->id
                        ]);
                    } else {
                        $error = $model->firstErrors;
                        return json_encode([
                            'code' => 202,
                            'status' => 0,
                            'message' => array_values($error),
                        ]);
                    }
                } else {
                    $coupon = Coupon::find()->where(['activity_id'=>$activity_id, 'customer_id'=>0, 'status'=>0])->one();
                    if (!$coupon){
                        return json_encode([
                            'code' => 1,
                            'status' => 0,
                            'message' => 'No enough coupon code'
                        ]);
                    }
                    $model->coupon_cost = $activity->coupon_type==1?$activity->price*($activity->coupon/100):$activity->coupon;
                    $model->coupon_code = $coupon->coupon_code;
                    $model->coupon_id = $coupon->id;
                    $coupon->customer_id = $user_id;
                    $coupon->status = 1;
                    $coupon->save();
                    $activity->qty = $activity->qty-1;
                    $activity->save();
                    $order_id = $model->save();
                    if ($order_id){
                        $coupon->order_id = $model->id;
                        $coupon->save();
                        return json_encode([
                            'code' => 1,
                            'status' => 2,
                            'message' => 'successful',
                            'coupon_code' => $coupon->coupon_code,
                            'link' => $activity->amazon_url,
                            'order_id' => $model->id
                        ]);
                    } else{
                        $error = $model->firstErrors;
                        return json_encode([
                            'code' => 202,
                            'status' => 0,
                            'message' => array_values($error),
                        ]);
                    }
                }
            } else {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 202,
                    'status' => 0,
                    'message' => array_values($error),
                ]);
            }
        } else {
            return json_encode([
                'code' => 201,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
    }

    public function actionSubmit()
    {
        if (Yii::$app->user->isGuest){
            return json_encode([
                'code' => 202,
                'status' => 0,
                'message' => 'please login in',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
        $param = Yii::$app->request->post();
        if (!isset($param['order_id']) || !isset($param['amz_order_id']) || !trim($param['order_id']) || !trim($param['amz_order_id'])){
            return json_encode([
                'code' => 201,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $order_id = $param['order_id'];
        $amz_order_id = trim($param['amz_order_id']);
        $model = Order::findOne($order_id);
        if (!$model){
            return json_encode([
                'code' => 203,
                'status' => 0,
                'message' => 'The deals is not exist'
            ]);
        }
        if ($model->user_id != $user_id){
            return json_encode([
                'code' => 204,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $user = User::findOne($user_id);
        if (empty($user->amazon_profile_url) || empty($user->paypal_account)){
            return json_encode([
                'code' => 205,
                'status' => 0,
                'message' => 'The request is illegal'
            ]);
        }
        $res = Order::find()->where(['amazon_order_id'=>$amz_order_id])->one();
        if ($res){
            return json_encode([
                'code' => 209,
                'status' => 0,
                'message' => 'Other order has already submitted this order ID'
            ]);
        }
        $model->amazon_order_id = $amz_order_id;
        $model->status = 2;
        if ($model->save()){
            return json_encode([
                'code' => 1,
                'status' => 2,
                'message' => 'successful'
            ]);
        } else {
            $error = $model->firstErrors;
            return json_encode([
                'code' => 207,
                'status' => 0,
                'message' => array_values($error)
            ]);
        }
    }
}