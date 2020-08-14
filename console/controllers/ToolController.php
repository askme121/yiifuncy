<?php

namespace console\controllers;

use common\models\Order;
use yii;
use yii\console\Controller;

class ToolController extends Controller
{
    public function actionExpire()
    {
        $expire_day = Yii::$app->params['order.Expire'];
        $list = Order::find()->where(['status'=>1])->andWhere(['<', 'created_at', time()-$expire_day*24*3600])->all();
        if ($list){
            foreach ($list as $item){
                $item->status = 7;
                $item->save();
            }
        }
    }

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