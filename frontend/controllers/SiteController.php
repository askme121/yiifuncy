<?php

namespace frontend\controllers;

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
                'backColor'=>0x000000,//背景颜色
                'maxLength' => 5, //最大显示个数
                'minLength' => 4,//最少显示个数
                'padding' => 5,//间距
                'height'=>35, //高度
                'width' => 130,  //宽度
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
        $top_all = Activity::find()->select($select)->innerJoinWith('product')->where(['t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->asArray()->all();
        $cashback_coupon = Activity::find()->select($select)->innerJoinWith('product')->where(['type'=>Activity::CASHBACK_COUPON_ACTIVITY,'t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->asArray()->all();
        $cashback = Activity::find()->select($select)->innerJoinWith('product')->where(['type'=>Activity::CASHBACK_ACTIVITY,'t_activity.status'=>1,'t_activity.site_id'=>$site_id])->andWhere(['<=', 'start', $time])->andWhere(['>=', 'end', $time])->limit(8)->asArray()->all();
        if ($top_all){
            foreach ($top_all as $kk=>$vv){
                switch ($vv['type'])
                {
                    case 1:
                        if ($vv['coupon_type'] == 1){
                            $top_all[$kk]['final_price'] = number_format($vv['price']*(1 - $vv['coupon']/100), 2);
                            $top_all[$kk]['total_off'] = $vv['coupon'];
                        } else {
                            $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $top_all[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 2);
                        }
                        break;
                    case 2:
                        $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $top_all[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $top_all[$kk]['final_price'] = number_format($vv['price'] * (1 - $vv['coupon']/100) - $vv['cashback'], 2);
                            $top_all[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        } else {
                            $top_all[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $top_all[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
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
                            $cashback_coupon[$kk]['total_off'] = $vv['coupon'];
                        } else {
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 2);
                        }
                        break;
                    case 2:
                        $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] * (1 - $vv['coupon']/100) - $vv['cashback'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        } else {
                            $cashback_coupon[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $cashback_coupon[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
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
                            $cashback[$kk]['total_off'] = $vv['coupon'];
                        } else {
                            $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'], 2);
                            $cashback[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100, 2);
                        }
                        break;
                    case 2:
                        $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['cashback'], 2);
                        $cashback[$kk]['total_off'] = number_format(number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        break;
                    case 3:
                        if ($vv['coupon_type'] == 1){
                            $cashback[$kk]['final_price'] = number_format($vv['price'] * (1 - $vv['coupon']/100) - $vv['cashback'], 2);
                            $cashback[$kk]['total_off'] = number_format($vv['coupon'] + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
                        } else {
                            $cashback[$kk]['final_price'] = number_format($vv['price'] - $vv['coupon'] - $vv['cashback'], 2);
                            $cashback[$kk]['total_off'] = number_format(number_format($vv['coupon']/$vv['price'], 2)*100 + number_format($vv['cashback']/$vv['price'], 2)*100, 2);
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
        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $site_id = Yii::$app->params['site_id'];
        $meta = [];
        $meta['title'] = 'Log In | '.Config::getConfig('web_site_title', $site_id);
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
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
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
}
