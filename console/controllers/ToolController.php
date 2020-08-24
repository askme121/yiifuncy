<?php

namespace console\controllers;

use common\models\Order;
use common\models\EmailRecord;
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

    public function actionEmail()
    {
        $list = EmailRecord::find()->where(['status'=>0])->all();
        if ($list){
            foreach ($list as $item){
                $status = Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                    ->setReplyTo([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
                    ->setTo($item->email)
                    ->setSubject($item->title)
                    ->setHtmlBody($item->content)
                    ->send();
                if ($status) {
                    $item->status = 1;
                    $item->save();
                }
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