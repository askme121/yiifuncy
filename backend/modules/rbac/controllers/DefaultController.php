<?php

namespace rbac\controllers;

use Yii;

class DefaultController extends \yii\web\Controller
{
    public function actionIndex($page = 'README.md')
    {
        if (strpos($page, '.png') !== false)
        {
            $file = Yii::getAlias("@rbac/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
        return $this->render('index', ['page' => $page]);
    }
}
