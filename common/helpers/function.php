<?php

use common\models\Config;
use common\models\Site;
use common\models\EmailRecord;

function getSymbol($site_id=null)
{
    $currency = Config::getConfig('currency');
    if ($currency)
    {
        $currency = unserialize($currency);
    }
    $currency_array = array_column($currency, null, 'currency_code');
    if (empty($site_id))
    {
        $curr_site_id = Yii::$app->session['default_site_id'];
    }
    else
    {
        $curr_site_id = $site_id;
    }
    $default_currency = Config::getConfig('default_currency', $curr_site_id);
    if (isset($currency_array[$default_currency]))
    {
        return $currency_array[$default_currency]['currency_symbol'];
    }
    return '';
}

function getImgUrl($url_path)
{
    $img_url = Config::getConfig('web_site_resources_url');
    if ($img_url)
    {
        return $img_url.$url_path;
    }
    else
    {
        return $url_path;
    }
}

function getClientIp()
{
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('REMOTE_ADDR')) {
        $ip = getenv('REMOTE_ADDR');
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getOrderID()
{
    $prefix = Yii::$app->params['order_prefix'];
    $order_id = $prefix.date('YmdHis').rand(1000, 9999);
    return $order_id;
}

function getSiteUrl($site_id)
{
    $site_url = Site::findOne($site_id)->domain;
    if ($site_url){
        return $site_url;
    } else {
        return '';
    }
}

function getIpInfo($ip)
{
    $url = Yii::$app->params['ip_api'].'/'.$ip;
    $data = curl_get($url);
    if ($data) {
        $data = json_decode($data, true);
    }
    return $data;
}

function curl_get($url)
{
    $header = array(
        'Accept: application/json',
    );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    $data = curl_exec($curl);
    if (curl_error($curl)) {
        return '';
    } else {
        curl_close($curl);
        return $data;
    }
}

function sendEmail($email, $email_content, $email_title, $params=[], $scene='')
{
    $email_content = htmlspecialchars_decode($email_content);
    if ($params){
        foreach ($params as $k => $v)
        {
            $email_content = str_replace('{{'.$k.'}}', $v, $email_content);
        }
    }
    $model = new EmailRecord();
    $model->title = $email_title;
    $model->email = $email;
    $model->scene = $scene;
    $model->content = $email_content;
    $model->save();
    $status = Yii::$app
        ->mailer
        ->compose()
        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
        ->setReplyTo([Yii::$app->params['adminEmail'] => Yii::$app->params['senderName']])
        ->setTo($email)
        ->setSubject($email_title)
        ->setHtmlBody($email_content)
        ->send();
    if ($status) {
        $model->status = 1;
        $model->save();
    }
    return true;
}