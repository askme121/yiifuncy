<?php

namespace rbac\controllers;

use Yii;
use rbac\models\Role;
use rbac\models\searchs\Role as RoleSearch;
use yii\base\ErrorException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Admin;

class RoleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $admin = Admin::find()->where(['role_id'=>$id])->all();
        if ($admin){
            return json_encode(['code'=>500, "msg"=>"该角色下存在用户，不能删除"]);
        }
        if($this->findModel($id)->delete()){
            return json_encode(['code'=>200, "msg"=>"删除成功"]);
        }else{
            return json_encode(['code'=>400, "msg"=>"删除失败"]);
        }
    }

    public function actionCreate()
    {
        $model = new Role;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else{
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"更新失败", "data"=>$error]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
