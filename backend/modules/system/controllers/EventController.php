<?php

namespace system\controllers;

use Yii;
use common\models\Event;
use common\models\searchs\EventSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;

class EventController extends Controller
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
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = Event::findOne($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}