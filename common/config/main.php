<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'timeZone' => 'America/Los_Angeles',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2cms',
            'username' => 'root',
            'password' => 'goodjob',
            'charset' => 'utf8',
            'tablePrefix' => 't_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'mailer' => [
            'class' => 'wadeshuler\sendgrid\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'apiKey' => '',
        ],
    ],
];
