<?php

namespace system\controllers;

use Yii;
use common\models\Trace;
use common\models\searchs\TraceSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;

class TraceController extends Controller
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
        $searchModel = new TraceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Trace::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}