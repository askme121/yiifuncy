<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'default site',
    'basePath' => dirname(__DIR__),
    'language' => 'en',
    'timeZone' => 'Asia/Shanghai',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '',
            'rules' => [
                'account/login' => '/site/login',
                'account/register' => '/site/signup',
                'captcha' => '/site/captcha',
                'account' => '/user/index',
                'contact' => '/site/contact',
                'faq' => '/site/faq',
                'terms' => '/site/terms',
                'aboutus' => '/site/about',
                'account/forgotpassword' => '/site/request-password-reset',
                'account/profile' => '/user/profile',
                'account/coupon' => '/order/coupon',
                'account/deal' => '/order/index',
                'order/deal' => '/order/deal',
                'account/amazon_profile_link' => '/user/amazon-profile-link',
                'account/password' => '/user/change-password',
                '<controller:(product)>' => '<controller>/index',
                [
                    'pattern' => 'product/<page:\d+>',
                    'route' => 'product/index',
                    'defaults' => ['page' => 1],
                ],
                [
                    'pattern' => 'product/<category>/<page:\d+>',
                    'route' => 'product/index',
                    'defaults' => ['category' => 'all', 'page' => 1],
                ],
                [
                    'pattern' => 'offer/<url>/<id:\d+>',
                    'route' => 'product/detail',
                    'defaults' => ['url' => '', 'id' => 0],
                ],
                [
                    'pattern' => 'order/upgrade/<id:\d+>',
                    'route' => 'order/uporder',
                    'defaults' => ['id' => 0],
                ],
                [
                    'pattern' => 'order/giveup/<id:\d+>',
                    'route' => 'order/give-up',
                    'defaults' => ['id' => 0],
                ],
                [
                    'pattern' => 'order/deal/<id:\d+>',
                    'route' => 'order/view',
                    'defaults' => ['id' => 0],
                ],
                [
                    'pattern' => 'contact/<order_id:\d+>',
                    'route' => 'site/contact',
                    'defaults' => ['order_id' => 0],
                ],
                [
                    'pattern' => 'account/password/reset/<token>',
                    'route' => 'site/reset-password',
                    'defaults' => ['token' => ''],
                ],
            ],
        ],
        'formatter' => [
            'dateFormat' => 'yyyy-MM-dd',
            'datetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'CNY',
        ],
    ],
    'params' => $params,
];
