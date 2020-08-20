<?php

namespace frontend\controllers;

use common\models\Contact;
use frontend\models\MessageForm;
use yii\data\Pagination;
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
                    ['allow' => true, 'actions' => ['amazon-profile-link', 'change-password', 'profile', 'change-url', 'ajax-message'], 'verbs' => ['POST']],
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
        $current = 'profile';
        $model = User::findOne($user_id);
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        if ($model->load(Yii::$app->request->post(), '')){
            $param = Yii::$app->request->post();
            if (isset($param['birth_year']) && isset($param['birth_month']) && isset($param['birth_day']) && !empty($param['birth_year']) && !empty($param['birth_month']) && !empty($param['birth_day'])){
                $model->birth_date = $param['birth_year'].'-'.$param['birth_month'].'-'.$param['birth_day'];
            }
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
            return $this->render('profile', ['meta'=>$meta, 'model'=>$model, 'current'=>$current]);
        }
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
        $redirect_url = isset($param['redirect_url'])?$param['redirect_url']:'';
        if (isset($param['amazon_profile_link']) && trim($param['amazon_profile_link']) && isset($param['paypal']) && trim($param['paypal'])){
            $user = User::find()->andWhere(['or',['amazon_profile_url'=>trim($param['amazon_profile_link'])], ['paypal_account'=>trim($param['paypal'])]])->one();
            if ($user){
                return json_encode([
                    'code' => 401,
                    'message' => 'The Amazon Profile URL or Paypal Account is already used',
                ]);
            }
            $model = User::findOne($user_id);
            $model->amazon_profile_url = trim($param['amazon_profile_link']);
            $model->paypal_account = trim($param['paypal']);
            if ($model->save()){
                return json_encode([
                    'code' => 1,
                    'message' => 'successful',
                    'redirect_url' => $redirect_url
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

    public function actionChangeUrl()
    {
        if (Yii::$app->user->isGuest) {
            return json_encode([
                'code' => 401,
                'message' => 'please login',
            ]);
        }
        $user_id = Yii::$app->user->identity->getId();
        $param = Yii::$app->request->post();
        if (isset($param['amazon_profile_link']) && trim($param['amazon_profile_link'])){
            $user = User::find()->where(['amazon_profile_url'=>trim($param['amazon_profile_link'])])->one();
            if ($user){
                return json_encode([
                    'code' => 401,
                    'message' => 'The Amazon Profile URL is already used',
                ]);
            }
            $model = User::findOne($user_id);
            if ($model->change_times > 0){
                return json_encode([
                    'code' => 402,
                    'message' => 'You can only update your amazon profile url for 1 time,please click "Contact Us" to contact our customer service team if you wish to change it again.',
                ]);
            }
            $model->amazon_profile_url = trim($param['amazon_profile_link']);
            $model->change_times += 1;
            if ($model->save()){
                return json_encode([
                    'code' => 1,
                    'message' => 'successful'
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

    public function actionMessage()
    {
        $site_id = Yii::$app->params['site_id'];
        $user_id = Yii::$app->user->identity->getId();
        $current = 'message';
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $type = Yii::$app->request->get('type');
        $query = Contact::find()->where(['site_id'=>$site_id, 'user_id'=>$user_id]);
        if (empty($type)) {
            $query->andWhere(['in', 'type', [2,3]]);
        } else {
            $query->andWhere(['type'=>$type]);
        }
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => '12']);
        $model = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('message', ['model'=>$model, 'meta'=>$meta, 'current'=>$current]);
    }

    public function actionMessageView($id)
    {
        $site_id = Yii::$app->params['site_id'];
        $model = Contact::findOne($id);
        if ($model->status == 0) {
            $model->status = 1;
            $model->save();
        }
        $meta = [];
        $current = 'message';
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('messageview', ['model'=>$model, 'meta'=>$meta, 'current'=>$current]);
    }

    public function actionAjaxMessage()
    {
        $model = new MessageForm();
        if ($model->load(Yii::$app->request->post(), '')) {
            if (!$model->validate()){
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 401,
                    'message' => array_values($error),
                ]);
            } else {
                $res = $model->doSubmit();
                if ($res === true) {
                    return json_encode([
                        'code' => 1,
                        'message' => 'Successful'
                    ]);
                } else {
                    return json_encode([
                        'code' => 0,
                        'message' => $res,
                    ]);
                }
            }
        }
    }
}