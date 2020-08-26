<?php

namespace system\controllers;

use Yii;
use common\models\EmailRecord;
use common\models\searchs\EmailRecordSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

class EmailRecordController extends Controller
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
        $searchModel = new EmailRecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = EmailRecord::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}