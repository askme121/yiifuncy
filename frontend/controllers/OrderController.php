<?php

namespace frontend\controllers;

use common\models\Activity;
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
        $user_id = Yii::$app->user->identity->getId();
        $model = new Order();
        if ($model->load(Yii::$app->request->post(), '')) {
            $activity_id = $model->activity_id;
            $activity = Activity::findOne($activity_id);
            if ($activity->type == 2){
                return json_encode([
                    'code' => 1,
                    'status' => 1,
                    'message' => 'successful',
                    'user_id' => $user_id
                ]);
            } else {
                return json_encode([
                    'code' => 1,
                    'status' => 2,
                    'message' => 'successful',
                    'coupon_code' => 'DESD-ETERTR-HTRYTR',
                    'link' => 'http://www.amazon.com',
                    'user_id' => $user_id
                ]);
            }
        } else {
            return json_encode([
                'code' => 201,
                'status' => 0,
                'message' => 'error',
                'user_id' => $user_id
            ]);
        }
    }
}