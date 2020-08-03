<?php

namespace console\controllers;

use yii;
use yii\console\Controller;

class ToolController extends Controller
{
    public function actionInit()
    {
        $str = '';
        $arr = explode("\n", $str);
        foreach ($arr as $vv)
        {
            $jj = explode("(", $vv);
            $connection  = Yii::$app->db;
            $sql = "insert into t_country (name, code) values ('".$jj[0]."', '".substr(trim($jj[1]), 0, -1)."');";
            echo $sql;
            $command = $connection->createCommand($sql);
            $res = $command->execute();
            var_dump($res);
        }
    }
}