<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Config;
use common\models\User;
use frontend\models\ChangePassword;
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
                    ['allow' => true, 'actions' => ['amazon-profile-link', 'change-password'], 'verbs' => ['POST']],
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
        $user_id = Yii::$app->user->identity->getId();
        if (empty($user_id)){
            return $this->render('site/error');
        }
        $model = User::findOne($user_id);
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('profile', ['meta'=>$meta, 'model'=>$model]);
    }

    public function actionAmazonProfileLink()
    {
        if (Yii::$app->user->isGuest) {
            return json_encode([
                'code' => 401,
                'message' => 'please login',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
        $param = Yii::$app->request->post();
        if (isset($param['amazon_profile_link']) && trim($param['amazon_profile_link']) && isset($param['paypal']) && trim($param['paypal'])){
            $model = User::findOne($user_id);
            $model->amazon_profile_url = trim($param['amazon_profile_link']);
            $model->paypal_account = trim($param['paypal']);
            if ($model->save()){
                return json_encode([
                    'code' => 1,
                    'message' => 'successful',
                ]);
            } else {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 402,
                    'message' => array_values($error),
                ]);
            }
        } else {
            return json_encode([
                'code' => 403,
                'message' => 'The request is illegal',
            ]);
        }
    }

    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post(), '') && $model->change()) {
            return json_encode([
                'code' => 1,
                'message' => 'successful',
            ]);
        } else {
            $error = $model->firstErrors;
            return json_encode([
                'code' => 402,
                'message' => array_values($error),
            ]);
        }
    }
}