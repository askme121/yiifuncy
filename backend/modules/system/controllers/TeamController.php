<?php

namespace system\controllers;

use Yii;
use backend\models\Admin;
use backend\models\Team;
use backend\models\searchs\TeamSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\Controller;

class TeamController extends Controller
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
        $searchModel = new TeamSearch();
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

    public function actionCreate()
    {
        $model = new Team();
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
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $admin = Admin::find()->where(['team_id'=>$id])->all();
        if ($admin){
            return json_encode(['code'=>500, "msg"=>"该团队下存在用户，不能删除"]);
        }
        if ($this->findModel($id)->delete()){
            return json_encode(['code'=>200, "msg"=>"删除成功"]);
        }else{
            return json_encode(['code'=>400, "msg"=>"删除失败"]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}