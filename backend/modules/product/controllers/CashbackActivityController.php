<?php

namespace product\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Activity;
use common\models\searchs\CashbackActivitySearch;
use yii\web\NotFoundHttpException;

class CashbackActivityController extends Controller
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
        $searchModel = new CashbackActivitySearch();
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
                $model->role_id = Yii::$app->user->identity->role_id;
                $model->team_id = Yii::$app->user->identity->team_id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->site_id = \Yii::$app->session['default_site_id'];
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
        if($model->delete()){
            return json_encode(['code'=>200,"msg"=>"删除成功"]);
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