<?php

use common\models\Config;

function getSymbol()
{
    $currency = Config::getConfig('currency');
    if ($currency)
    {
        $currency = unserialize($currency);
    }
    $currency_array = array_column($currency, null, 'currency_code');
    $curr_site_id = \Yii::$app->session['default_site_id'];
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