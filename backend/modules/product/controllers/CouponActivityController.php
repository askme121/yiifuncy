<?php

namespace product\controllers;

use common\models\Coupon;
use Faker\Provider\Uuid;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Activity;
use common\models\searchs\CouponActivitySearch;
use yii\web\NotFoundHttpException;

class CouponActivityController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new CouponActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Activity::find()->with('product')->where(['id'=>$id])->one();
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Activity();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if (empty($model->url_key)){
                    $model->url_key = Uuid::uuid();
                }
                if ($model->start){
                    $model->start = strtotime($model->start);
                }
                if ($model->end){
                    $model->end = strtotime($model->end);
                }
                if ($model->start && $model->end && $model->start >= $model->end){
                    return json_encode(['code'=>500, "msg"=>"开始时间不能大于结束时间"]);
                }
                if (trim($model->form_coupon_code)){
                    $coupon = trim($model->form_coupon_code);
                    $coupon_arr = explode("\r\n", $coupon);
                    $coupon_arr = array_unique($coupon_arr);
                    if ($coupon_arr){
                        $model->qty = count($coupon_arr);
                    }
                }
                $model->role_id = Yii::$app->user->identity->role_id;
                $model->team_id = Yii::$app->user->identity->team_id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->site_id = \Yii::$app->session['default_site_id'];
                $model->type = Activity::COUPON_ACTIVITY;
                $model->save();
                if (isset($coupon_arr) && $coupon_arr){
                    foreach ($coupon_arr as $vv){
                        $m = new Coupon();
                        $m->coupon_code = $vv;
                        $m->activity_id = $model->id;
                        $m->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        } else {
            return $this->render('create', ['model' => $model,]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if ($model->start){
                    $model->start = strtotime($model->start);
                }
                if ($model->end){
                    $model->end = strtotime($model->end);
                }
                if ($model->start && $model->end && $model->start >= $model->end){
                    return json_encode(['code'=>500, "msg"=>"开始时间不能大于结束时间"]);
                }
                if (trim($model->form_coupon_code)){
                    $coupon = trim($model->form_coupon_code);
                    $coupon_arr = explode("\r\n", $coupon);
                    $coupon_arr = array_unique($coupon_arr);
                    if ($coupon_arr){
                        $model->qty = count($coupon_arr);
                    }
                }
                $r = $model->save();
                if (isset($coupon_arr) && $coupon_arr){
                    foreach ($coupon_arr as $vv){
                        $m = new Coupon();
                        $m->coupon_code = $vv;
                        $m->activity_id = $model->id;
                        $m->save();
                    }
                }
                if ($r!==false){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);
        if($model->status == Activity::STATUS_ENABLE){
            return json_encode(['code'=>400,"msg"=>"该活动已经是启用状态"]);
        }
        $model->status = Activity::STATUS_ENABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"启用成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionInactive($id)
    {
        $model = $this->findModel($id);
        if($model->status == Activity::STATUS_DISABLE){
            return json_encode(['code'=>400,"msg"=>"该活动已经是下架状态"]);
        }
        $model->status = Activity::STATUS_DISABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"下架成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionCopy($id)
    {
        $model = $this->findModel($id);
        $m = new Activity();
        $m->product_id = $model->product_id;
        $m->type = $model->type;
        $m->price = $model->price;
        $m->cashback = $model->cashback;
        $m->coupon_type = $model->coupon_type;
        $m->coupon = $model->coupon;
        $m->amazon_url = $model->amazon_url;
        $m->start = null;
        $m->end = null;
        $m->qty = 0;
        $m->role_id = $model->role_id;
        $m->team_id = $model->team_id;
        $m->user_id = $model->user_id;
        $m->site_id = $model->site_id;
        $m->status = Activity::STATUS_INIT;
        $m->url_key = Uuid::uuid();
        if($m->save()){
            return json_encode(['code'=>200,"msg"=>"复制成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = Activity::STATUS_CANCEL;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"取消成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Activity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}