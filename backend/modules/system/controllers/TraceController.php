<?php

namespace system\controllers;

use Yii;
use common\models\Trace;
use common\models\searchs\TraceSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\db\Query;

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

    public function actionGrid()
    {
        $query1 = new Query();
        $rows1 = $query1->select(['ip', 'access_date', 'COUNT(*) as num'])
                 ->from('t_trace')
                 ->where(['access_date'=>date("Y-m-d")])
                 ->groupBy('ip')
                 ->all();
        $x1 = [];
        $y1 = [];
        foreach ($rows1 as $value) {
            $x1[] = $value['ip'];
            $y1[] = $value['num'];
        }
        $query2 = new Query();
        $rows = $query2->select(['access_date', 'COUNT(*) as num'])
                ->from('t_trace')
                ->orderBy('access_date desc')
                ->groupBy('access_date')
                ->limit(15)
                ->all();
        $x = [];
        $y = [];
        foreach ($rows as $value) {
            $x[] = $value['access_date'];
            $y[] = $value['num'];
        }
        return $this->render('grid', ["data"=>['x'=>$x,'y'=>$y,'x1'=>$x1,'y1'=>$y1]]);
    }
}