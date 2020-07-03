<?php

namespace rbac\controllers;

use Yii;
use rbac\models\Rule;
use yii\web\Controller;
use rbac\models\searchs\Rule as RuleSearch;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class RuleController extends Controller
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
        $searchModel = new RuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Rule;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if ($model->parent > 0){
                    $parent_model = $this->findModel($model->parent);
                    if ($parent_model){
                        $model->deepth = $parent_model->deepth + 1;
                    } else {
                        $model->deepth = 1;
                    }
                } else {
                    $model->deepth = 1;
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
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
                if ($model->parent == $model->id) {
                    throw new NotFoundHttpException('父级不能为自己本身');
                }
                if ($model->parent > 0){
                    $parent_model = $this->findModel($model->parent);
                    if ($parent_model){
                        $model->deepth = $parent_model->deepth + 1;
                    } else {
                        $model->deepth = 1;
                    }
                } else {
                    $model->deepth = 1;
                }
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                $error = $model->firstErrors;
                return json_encode(['code'=>500, "msg"=>"更新失败", "data"=>$error]);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }

    public function actionDelete($id)
    {
		if($this->findModel($id)->delete()){
			return json_encode(['code'=>200, "msg"=>"删除成功"]);
		}else{
			return json_encode(['code'=>400, "msg"=>"删除失败"]);
		}
    }

    protected function findModel($id)
    {
        if (($model = Rule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
