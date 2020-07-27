<?php

use common\models\Config;

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
        $curr_site_id = \Yii::$app->session['default_site_id'];
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