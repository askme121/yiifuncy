<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/sweetalert.css',
        'css/site.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/jquery.elevatezoom.js',
        'js/sweetalert.min.js',
        'js/common.js',
        'js/site.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
