<?php

namespace product\controllers;

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
                $model->role_id = Yii::$app->user->identity->role_id;
                $model->team_id = Yii::$app->user->identity->team_id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->site_id = \Yii::$app->session['default_site_id'];
                $model->type = Activity::COUPON_ACTIVITY;
                $model->save();
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
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
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
            return json_encode(['code'=>400,"msg"=>"该活动已经是上架状态"]);
        }
        $model->status = Activity::STATUS_ENABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"上架成功"]);
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