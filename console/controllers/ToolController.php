<?php

namespace console\controllers;

use common\models\Order;
use common\models\EmailRecord;
use yii;
use yii\console\Controller;
use wsl\ip2location\Ip2Location;

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
                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
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
        //$data = getIpInfo('14.155.156.70');
        //var_dump($data);

        $ipLocation = new Ip2Location();
        $locationModel = $ipLocation->getLocation('14.30.33.139');
        print_r($locationModel->toArray());
    }
}