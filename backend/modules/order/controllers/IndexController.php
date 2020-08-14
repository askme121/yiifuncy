<?php

namespace order\controllers;

use common\models\searchs\OrderSearch;
use common\models\Order;
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
        $model->status = 3;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"审核成功"]);
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
        $model->status = 4;
        $res = Order::find()->where(['product_id'=>$model->product_id, 'user_id'=>$model->user_id, 'status'=>4, 'is_review'=>1])->one();
        if ($res){
            $model->is_review = 1;
        }
        if($model->save()){
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
}