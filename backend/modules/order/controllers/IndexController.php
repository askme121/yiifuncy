<?php

namespace order\controllers;

use common\models\searchs\OrderSearch;
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
}