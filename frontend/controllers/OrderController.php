<?php

namespace frontend\controllers;

use common\models\Activity;
use common\models\Coupon;
use common\models\Product;
use common\models\User;
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
                'only' => ['index', 'view'],
                'rules' => [
                    [
                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
                $hover_order = Order::find()->where(['user_id'=>$user_id])->andWhere(['<>', 'activity_id', $activity_id])->andWhere(['>', 'created_at', time()-$expire_day*24*3600])->andWhere(['<', 'status', 5])->all();
                if ($hover_order){
                    return json_encode([
                        'code' => 1,
                        'status' => 7,
                        'message' => 'you have unfinished deals'
                    ]);
                }
                $curr_order = Order::find()->where(['user_id'=>$user_id, 'activity_id'=>$activity_id])->andWhere(['>', 'created_at', time()-$expire_day*24*3600])->andWhere(['<', 'status', 5])->all();
                if ($curr_order){
                    return json_encode([
                        'code' => 1,
                        'status' => 6,
                        'message' => 'you have unfinished deals'
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
}