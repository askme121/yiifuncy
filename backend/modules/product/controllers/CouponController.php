<?php

namespace product\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Coupon;
use common\models\searchs\CouponSearch;
use yii\web\NotFoundHttpException;

class CouponController extends Controller
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
        $searchModel = new CouponSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate($id)
    {
        $model = new Coupon();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if ($model->expired_at){
                    $expired_at = strtotime($model->expired_at);
                }
                $coupon = trim($model->coupon_code);
                if (empty($coupon)){
                    return json_encode(['code'=>402, "msg"=>"请填写优惠券"]);
                }
                $coupon_arr = explode("\r\n", $coupon);
                $coupon_arr = array_unique($coupon_arr);
                if ($coupon_arr){
                    foreach ($coupon_arr as $vv){
                        $model = new Coupon();
                        $model->coupon_code = $vv;
                        $model->role_id = Yii::$app->user->identity->role_id;
                        $model->team_id = Yii::$app->user->identity->team_id;
                        $model->user_id = Yii::$app->user->identity->id;
                        $model->site_id = \Yii::$app->session['default_site_id'];
                        $model->expired_at = $expired_at;
                        $model->save();
                    }
                }
                return json_encode(['code'=>200, "msg"=>"添加成功"]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        } else {
            $model->product_id = $id;
            return $this->render('create', ['model' => $model]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Coupon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}