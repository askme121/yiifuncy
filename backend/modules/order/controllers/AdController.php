<?php

namespace order\controllers;

use common\models\AdLink;
use common\models\searchs\AdLinkSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdController extends Controller
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
        $searchModel = new AdLinkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = AdLink::findOne($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new AdLink();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()){
                $link = $model->link;
                $param = parse_url($link);
                $path_arr = explode("/", $param['path']);
                $activity_id = end($path_arr);
                $query_arr = explode("&", $param['query']);
                $query = [];
                foreach ($query_arr as $vo)
                {
                    $vo_arr = explode("=", $vo);
                    $query[$vo_arr[0]] = $vo_arr[1];
                }
                $model->activity_id = $activity_id;
                if (isset($query['tag'])) {
                    $model->tag = $query['tag'];
                }
                if (isset($query['code'])) {
                    $model->sign = $query['code'];
                }
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
        $model = AdLink::findOne($id);
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
}