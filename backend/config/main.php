<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' => '后台管理系统',
    'basePath' => dirname(__DIR__),
    'language' => 'zh-CN',
    'timeZone' => 'America/Los_Angeles',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        "rbac" => [
            'class' => 'rbac\Module',
        ],
        "system" => [
            'class' => 'system\Module',
        ],
        "backup" => [
            'class' => 'backup\Module',
        ],
        "product" => [
            'class' => 'product\Module',
        ],
        "order" => [
            'class' => 'order\Module',
        ],
        "article" => [
            'class' => 'article\Module',
        ],
    ],
    "aliases" => [
        '@rbac' => '@backend/modules/rbac',
        '@system' => '@backend/modules/system',
        '@backup' => '@backend/modules/backup',
        '@product' => '@backend/modules/product',
        '@order' => '@backend/modules/order',
        '@article' => '@backend/modules/article',
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'loginUrl' => array('/site/login'),
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        "authManager" => [
            "class" => 'rbac\components\DbManager',
            "defaultRoles" => ["guest"],
        ],
        "urlManager" => [
            "enablePrettyUrl" => true,
            "enableStrictParsing" => false,
            "showScriptName" => false,
            "suffix" => "",
            "rules" => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
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
    'as access' => [
        'class' => 'rbac\components\AccessControl',
        'allowActions' => [
            'rbac/user/request-password-reset',
            'rbac/user/reset-password'
        ]
    ],
    'params' => $params,
];
