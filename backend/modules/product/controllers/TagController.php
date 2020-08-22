<?php

namespace product\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Tag;
use common\models\searchs\TagSearch;

class TagController extends Controller
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
        $searchModel = new TagSearch();
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

    public function actionCreate()
    {
        $model = new Tag();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $model->role_id = Yii::$app->user->identity->role_id;
                $model->team_id = Yii::$app->user->identity->team_id;
                $model->user_id = Yii::$app->user->identity->id;
                $model->site_id = Yii::$app->session['default_site_id'];
                $res = $model->save();
                if ($res){
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $error = $model->firstErrors;
                    return json_encode(['code'=>500, "msg"=>"操作失败", "data"=>$error]);
                }
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
                $res = $model->save();
                if ($res !== false){
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    $error = $model->firstErrors;
                    return json_encode(['code'=>500, "msg"=>"操作失败", "data"=>$error]);
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
        if($model->status == Tag::STATUS_ENABLE){
            return json_encode(['code'=>400,"msg"=>"该标签已经是激活状态"]);
        }
        $model->status = Tag::STATUS_ENABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"激活成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    public function actionInactive($id)
    {
        $model = $this->findModel($id);
        if($model->status == Tag::STATUS_DISABLE){
            return json_encode(['code'=>400,"msg"=>"该标签已经是禁用状态"]);
        }
        $model->status = Tag::STATUS_DISABLE;
        if($model->save()){
            return json_encode(['code'=>200,"msg"=>"关闭成功"]);
        }else{
            $errors = $model->firstErrors;
            return json_encode(['code'=>400,"msg"=>reset($errors)]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}