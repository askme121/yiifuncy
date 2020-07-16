<?php

namespace rbac\components;

use Yii;
use yii\di\Instance;
use yii\helpers\ArrayHelper;

class Configs extends \yii\base\BaseObject
{
    const CACHE_TAG = 'mdm.admin';

    public $authManager = 'authManager';
    public $db = 'db';
    public $userDb = 'db';
    public $cache = 'cache';
    public $adminLogTable = '{{%admin_log}}';
    public $cacheDuration = 3600;
    public $defaultUserStatus = 10;
    public $onlyRegisteredRoute = false;
    public $strict = true;
    public $options;

    private static $_instance;
    private static $_classes = [
        'db' => 'yii\db\Connection',
        'userDb' => 'yii\db\Connection',
        'cache' => 'yii\caching\Cache',
        'authManager' => 'yii\rbac\ManagerInterface',
    ];

    public function init()
    {
        foreach (self::$_classes as $key => $class) {
            try {
                $this->{$key} = empty($this->{$key}) ? null : Instance::ensure($this->{$key}, $class);
            } catch (\Exception $exc) {
                $this->{$key} = null;
                Yii::error($exc->getMessage());
            }
        }
    }

    public static function instance()
    {
        if (self::$_instance === null) {
            $type = ArrayHelper::getValue(Yii::$app->params, 'mdm.admin.configs', []);
            if (is_array($type) && !isset($type['class'])) {
                $type['class'] = static::className();
            }

            return self::$_instance = Yii::createObject($type);
        }
        return self::$_instance;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = static::instance();
        if ($instance->hasProperty($name)) {
            return $instance->$name;
        } else {
            if (count($arguments)) {
                $instance->options[$name] = reset($arguments);
            } else {
                return array_key_exists($name, $instance->options) ? $instance->options[$name] : null;
            }
        }
    }

    public static function db()
    {
        return static::instance()->db;
    }

    public static function userDb()
    {
        return static::instance()->userDb;
    }

    public static function cache()
    {
        return static::instance()->cache;
    }

    public static function authManager()
    {
        return static::instance()->authManager;
    }

    public static function strict()
    {
        return static::instance()->strict;
    }
}
