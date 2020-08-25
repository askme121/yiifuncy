<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\Trace;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use yii\helpers\Url;
use Yii;
use common\models\Config;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Activity;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['login','signup','captcha'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                'backColor'=>0x666666,//背景颜色
                'maxLength' => 5, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>35, //高度
                'width' => 70,  //宽度
                'foreColor'=>0xffffff, //字体颜色
                'offset'=>4, //设置字符偏移量 有效果
            ],
        ];
    }

    public function actionIndex()
    {
        $site_id = Yii::$app->params['site_id'];
        $time = time();
        $meta = [];
        $meta['title'] = Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $select = "t_activity.id,t_activity.url_key,product_id,type,price,cashback,coupon_type,coupon,price,qty";
        $top_all = Activity::find()->select($select)->innerJoinWith('product')->where(['t_activity.status'=>1, 't_activity.is_hot'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->orderBy("t_activity.order")->asArray()->all();
        $cashback_coupon = Activity::find()->select($select)->innerJoinWith('product')->where(['type'=>Activity::CASHBACK_COUPON_ACTIVITY,'t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->orderBy("t_activity.order")->asArray()->all();
        $cashback = Activity::find()->select($select)->innerJoinWith('product')->where(['type'=>Activity::CASHBACK_ACTIVITY,'t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->orderBy("t_activity.order")->asArray()->all();
        if ($top_all){
            foreach ($top_all as $kk=>$vv){
                switch ($vv['type'])
                {
                    case 1:
                        if ($vv['coupon_type'] == 1){
                            $top_all[$kk]['final_price'] = number_format($vv['price']*(1 - $vv['coupon']/100), 2);
                            $top_all[$kk]['total_off'] = number_format($vv['coupon'], 0);
                        } else {
                            $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $top_all[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    case 2:
                        $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $top_all[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $top_all[$kk]['final_price'] = number_format(number_format($vv['price'] * (1 - $vv['coupon']/100), 2) - $vv['cashback'], 2);
                            $top_all[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        } else {
                            $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $top_all[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    default:
                        $top_all[$kk]['final_price'] = 0;
                        $top_all[$kk]['total_off'] = 0;
                        break;
                }
            }
        }
        if ($cashback_coupon){
            foreach ($cashback_coupon as $kk=>$vv){
                switch ($vv['type'])
                {
                    case 1:
                        if ($vv['coupon_type'] == 1){
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price']*(1 - $vv['coupon']/100), 2);
                            $cashback_coupon[$kk]['total_off'] = number_format($vv['coupon'], 0);
                        } else {
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    case 2:
                        $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $cashback_coupon[$kk]['final_price'] = number_format(number_format($vv['price'] * (1 - $vv['coupon']/100), 2) - $vv['cashback'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        } else {
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    default:
                        $cashback_coupon[$kk]['final_price'] = 0;
                        $cashback_coupon[$kk]['total_off'] = 0;
                        break;
                }
            }
        }
        if ($cashback){
            foreach ($cashback as $kk=>$vv){
                switch ($vv['type'])
                {
                    case 1:
                        if ($vv['coupon_type'] == 1){
                            $cashback[$kk]['final_price'] = number_format($vv['price']*(1 - $vv['coupon']/100), 2);
                            $cashback[$kk]['total_off'] = number_format($vv['coupon'], 0);
                        } else {
                            $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $cashback[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    case 2:
                        $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $cashback[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $cashback[$kk]['final_price'] = number_format(number_format($vv['price'] * (1 - $vv['coupon']/100), 2) - $vv['cashback'], 2);
                            $cashback[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        } else {
                            $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $cashback[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 0);
                        }
                        break;
                    default:
                        $cashback[$kk]['final_price'] = 0;
                        $cashback[$kk]['total_off'] = 0;
                        break;
                }
            }
        }
        return $this->render('index', ['meta'=>$meta,'top_all'=>$top_all, 'cashbackCouponProducts'=>$cashback_coupon, 'cashbackProducts'=>$cashback]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = 'Log In | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $model = new LoginForm();
        if (Yii::$app->request->post()) {
            $param = Yii::$app->request->post();
            if ($model->load($param, '')){
                if (!$model->validate()) {
                    $error = $model->firstErrors;
                    return json_encode([
                        'code' => 401,
                        'message' => array_values($error),
                    ]);
                } else {
                    if ($model->login()) {
                        return json_encode([
                            'code' => 1,
                            'message' => 'login successful',
                            'href' => Url::home(),
                        ]);
                    } else {
                        return json_encode([
                            'code' => 0,
                            'message' => 'login failed',
                        ]);
                    }
                }
            } else {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 400,
                    'message' => $error,
                ]);
            }
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model, 'meta' => $meta
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        if (Yii::$app->request->isAjax){
            return json_encode([
                'code' => 1,
                'message' => 'logout successful',
                'href' => Url::home(),
            ]);
        } else {
            return $this->goHome();
        }
    }

    public function actionContact()
    {
        $site_id = Yii::$app->params['site_id'];
        $page = Article::find()->where(['url_key'=>'contact', 'site_id'=>$site_id])->one();
        if (!$page){
            return $this->render('/site/error');
        }
        $meta = [];
        $meta['title'] = $page->meta_title;
        $meta['description'] = $page->meta_description;
        $meta['keyword'] = $page->meta_keywords;
        $model = new ContactForm();
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
                        'message' => 'Thank you for contacting us. We will respond to you as soon as possible.'
                    ]);
                } else {
                    return json_encode([
                        'code' => 0,
                        'message' => $res,
                    ]);
                }
            }
        } else {
            return $this->render('contact', [
                'model' => $model,
                'page' => $page,
                'meta' => $meta
            ]);
        }
    }

    public function actionAbout()
    {
        $site_id = Yii::$app->params['site_id'];
        $model = Article::find()->where(['url_key'=>'about_us', 'site_id'=>$site_id])->one();
        if (!$model){
            return $this->render('/site/error');
        }
        $meta = [];
        $meta['title'] = $model->meta_title;
        $meta['description'] = $model->meta_description;
        $meta['keyword'] = $model->meta_keywords;
        return $this->render('about', ['model'=>$model, 'meta'=>$meta]);
    }

    public function actionFaq()
    {
        $site_id = Yii::$app->params['site_id'];
        $model = Article::find()->where(['cate_id'=>1])->orderBy("order")->all();
        $meta = [];
        $meta['title'] = 'Faq | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('faq', ['model'=>$model, 'meta'=>$meta]);
    }

    public function actionTerms()
    {
        $site_id = Yii::$app->params['site_id'];
        $model = Article::find()->where(['cate_id'=>1])->orderBy("order")->all();
        $meta = [];
        $meta['title'] = 'Terms | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        return $this->render('term', ['model'=>$model, 'meta'=>$meta]);
    }

    public function actionSignup()
    {
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = 'Sign Up | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post(), '')) {
            if (!$model->validate()) {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 401,
                    'message' => array_values($error),
                ]);
            } else {
                if ($model->signup()) {
                    return json_encode([
                        'code' => 1,
                        'message' => 'register successful',
                        'href' => Url::home(),
                    ]);
                } else {
                    return json_encode([
                        'code' => 0,
                        'message' => 'register failed',
                    ]);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model, 'meta' => $meta
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = 'Forgot Password | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate()) {
                if ($model->sendEmail()) {
                    return json_encode([
                        'code' => 1,
                        'message' => 'Check your email for further instructions.',
                    ]);
                } else {
                    return json_encode([
                        'code' => 0,
                        'message' => 'Sorry, we are unable to reset password for the provided email address.',
                    ]);
                }
            } else {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 401,
                    'message' => array_values($error),
                ]);
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
            'meta' => $meta
        ]);
    }

    public function actionResetPassword($token)
    {
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = 'Reset the Password | '.Config::getConfig('web_site_title', $site_id);
        $meta['description'] = Config::getConfig('web_site_description', $site_id);
        $meta['keyword'] = Config::getConfig('web_site_keyword', $site_id);
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post(), '')) {
            if ($model->validate() && $model->resetPassword()) {
                return json_encode([
                    'code' => 1,
                    'message' => 'The account '.$model->email.' password is reset.You can Login it',
                ]);
            } else {
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 401,
                    'message' => array_values($error),
                ]);
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
            'meta' => $meta
        ]);
    }

    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionTrace()
    {
        $model = new Trace();
        if ($model->load(Yii::$app->request->post(), '')) {
            if (!$model->validate()){
                $error = $model->firstErrors;
                return json_encode([
                    'code' => 401,
                    'message' => array_values($error),
                ]);
            } else {
                $model->site_id = Yii::$app->params['site_id'];
                $model->ip = Yii::$app->getRequest()->getUserIP();
                $model->access_date = date("Y-m-d");
                $res = Trace::find()->where(['uuid'=>$model->uuid, 'ip'=>$model->ip, 'url'=>$model->url, 'device'=>$model->device, 'browser'=>$model->browser, 'access_date'=>$model->access_date])->one();
                if ($res) {
                    if (time() - $res->created_at > 120) {
                        $res->times += 1;
                        $res->save();
                    }
                    return json_encode([
                        'code' => 1,
                        'message' => 'successful'
                    ]);
                } else {
                    if (!Yii::$app->user->isGuest){
                        $model->user_id = Yii::$app->user->identity->id;
                    }
                    $res = $model->save();
                    if ($res) {
                        return json_encode([
                            'code' => 1,
                            'message' => 'successful'
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
}
