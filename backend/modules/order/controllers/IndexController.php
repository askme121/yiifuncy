<?php

namespace order\controllers;

use common\models\Activity;
use common\models\Contact;
use common\models\EmailTemplate;
use common\models\searchs\OrderSearch;
use common\models\Order;
use common\models\User;
use yii\helpers\Html;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;

class IndexController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'check' => ['POST'],
                    'cashback' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Order::find()->innerJoinWith('activity')
            ->innerJoinWith('product')->where(['t_order.id'=>$id])->one();
        return $this->render('view', ['model' => $model]);
    }

    public function actionChecklist()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->check(Yii::$app->request->queryParams);
        return $this->render('checklist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRepaylist()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->cashback(Yii::$app->request->queryParams);
        return $this->render('repaylist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionOverlist()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->over(Yii::$app->request->queryParams);
        return $this->render('overlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReviewlist()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->review(Yii::$app->request->queryParams);
        return $this->render('reviewlist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCheck($id)
    {
        $model = Order::findOne($id);
        if ($model->status != 2 || empty($model->amazon_order_id)){
            return json_encode(['code'=>401,"msg"=>'订单不符合审核条件']);
        }
        $user = User::findOne($model->user_id);
        $site_id = $model->site_id;
        $template = EmailTemplate::find()->where(['site_id'=>$site_id, 'scene'=>'checked'])->one();
        $email_content = $template->content;
        $email_title = $template->title;
        $params['user_name'] = $user->firstname.' '.$user->lastname;
        $model->status = 3;
        if($model->save()){
            $ref = sendEmail($user->email, $email_content, $email_title, $params, 'checked');
            if ($ref){
                return json_encode(['code'=>200,"msg"=>"审核成功"]);
            } else {
                return json_encode(['code'=>200,"msg"=>"审核成功","res"=>$ref]);
            }
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionCashback($id)
    {
        $model = Order::findOne($id);
        if ($model->status != 3 || empty($model->amazon_order_id)){
            return json_encode(['code'=>401,"msg"=>'订单不符合返现条件']);
        }
        $user = User::findOne($model->user_id);
        $activity = Activity::findOne($model->activity_id);
        $site_id = $model->site_id;
        $template = EmailTemplate::find()->where(['site_id'=>$site_id, 'scene'=>'paypal'])->one();
        $email_content = $template->content;
        $email_title = $template->title;
        $params['user_name'] = $user->firstname.' '.$user->lastname;
        $params['link'] = 'https://www.amazon.com/review/review-your-purchases/?asin='.$activity->asin;
        $model->status = 4;
        $res = Order::find()->where(['product_id'=>$model->product_id, 'user_id'=>$model->user_id, 'status'=>4, 'is_review'=>1])->one();
        if ($res){
            $model->is_review = 1;
        }
        if($model->save()){
            sendEmail($user->email, $email_content, $email_title, $params, 'paypal');
            return json_encode(['code'=>200,"msg"=>"操作成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionReview($id)
    {
        $model = Order::findOne($id);
        if ($model->status != 4 || $model->is_review != 0 || empty($model->amazon_order_id)){
            return json_encode(['code'=>401,"msg"=>'订单不符合返现条件']);
        }
        $model->is_review = 1;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"操作成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionEmail($id)
    {
        $site_id = Yii::$app->session['default_site_id'];
        $template = EmailTemplate::find()->where(['site_id'=>$site_id, 'scene'=>'access'])->one();
        if ($template) {
            $title = $template->title;
            $content = $template->content;
        } else {
            $title = '';
            $content = '';
        }
        $model = Order::findOne($id);
        $user = User::findOne($model->user_id);
        $params['user_name'] = Html::encode($user->firstname. ' '. $user->lastname);
        if (Yii::$app->request->post()) {
            $param = Yii::$app->request->post();
            $mail_title = $param['title']??'';
            $mail_content = $param['content']??'';
            $params['msg'] = $mail_content;
            $mo = new Contact();
            $mo->user_id = $model->user_id;
            $mo->name = $params['user_name'];
            $mo->email = $model->user_email;
            $mo->order_id = $id;
            $mo->site_id = $site_id;
            $mo->type = 2;
            $mo->ip = Yii::$app->getRequest()->getUserIP();
            $msg_content = htmlspecialchars_decode($content);
            if ($params){
                foreach ($params as $k => $v)
                {
                    $msg_content = str_replace('{{'.$k.'}}', $v, $msg_content);
                }
            }
            $mo->title = $mail_title;
            $mo->content = $msg_content;
            $mo->save();
            sendEmail($model->user_email, $content, $mail_title, $params, 'access');
            return $this->renderContent('<h5 style="text-align: center; margin-top: 15px">send successful</h5>');
        }
        return $this->render('email', ['model' => $model, 'title'=>$title]);
    }
}