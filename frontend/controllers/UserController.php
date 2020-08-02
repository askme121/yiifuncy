<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Config;
use Yii;

class UserController extends Controller
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
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('index', ['meta'=>$meta]);
    }

    public function actionProfile()
    {
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('profile', ['meta'=>$meta]);
    }
}