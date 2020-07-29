<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
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

    public function actionDeals()
    {
        if (Yii::$app->user->isGuest){
            return json_encode([
                'code' => 201,
                'message' => 'please login in',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
    }
}