<?php

namespace frontend\controllers;

use yii\web\Controller;
use Yii;

class ProductController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        var_dump(Yii::$app->request->get());
        //return $this->render('index');
    }

    public function actionDetail()
    {
        var_dump(Yii::$app->request->get());
        //return $this->render('detail');
    }
}
