<?php

namespace product\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\models\Category;
use common\models\searchs\CategorySearch;
use yii\web\NotFoundHttpException;

class CategoryController extends Controller
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
        $searchModel = new CategorySearch();
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
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                if ($model->parent_id > 0){
                    $parent_model = $this->findModel($model->parent_id);
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
                if ($model->parent_id == $model->id) {
                    throw new NotFoundHttpException('父级不能为自己本身');
                }
                if ($model->parent_id > 0){
                    $parent_model = $this->findModel($model->parent_id);
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
                return json_encode(['code'=>500, "msg"=>"验证失败", "data"=>$error]);
            }
        }
        return $this->render('update', ['model' => $model,]);
    }

    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}