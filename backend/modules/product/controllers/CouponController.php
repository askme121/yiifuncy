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

    protected function findModel($id)
    {
        if (($model = Coupon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}