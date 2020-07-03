<?php

namespace rbac\models;

use yii;
use rbac\components\Configs;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Log extends ActiveRecord
{
    public $userClassName;

    public function init()
    {
        parent::init();
        if ($this->userClassName === null) {
            $this->userClassName = Yii::$app->getUser()->identityClass;
            $this->userClassName = $this->userClassName ? : 'backend\models\Admin';
        }
    }

    public function rules()
    {
        return [
            [['route', 'url', 'user_agent', 'admin_email', 'ip'], 'string', 'min' => 0, 'max' => 255],
            [['admin_id', 'route', 'url'], 'required'],
            [['admin_id'], 'integer', 'min' => 0, 'max' => 2147483647],
        ];
    }

	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public static function tableName()
    {
        return Configs::instance()->adminLogTable;
    }

    public static function addLog($action)
    {
        $model = new Log();

        $model->route = $action->uniqueId;
        $model->url = Yii::$app->request->absoluteUrl;

        $headers = Yii::$app->request->headers;

        if ($headers->has('User-Agent')) {
            $model->user_agent =  $headers->get('User-Agent');
        }

        $model->gets = json_encode(Yii::$app->request->get());
        $model->posts = json_encode(Yii::$app->request->post());
        $model->admin_id = Yii::$app->user->identity['id'];
        $model->admin_email = Yii::$app->user->identity['email'];
        $model->ip = Yii::$app->request->userIP;

        $model->save();

    }

    public function attributeLabels()
    {
        return [
            'route' => Yii::t('rbac-admin', '路由'),
            'url' => Yii::t('rbac-admin', '链接'),
            'admin' => Yii::t('rbac-admin', '用户'),
            'admin_email' => Yii::t('rbac-admin', '邮箱'),
            'ip' => Yii::t('rbac-admin', 'IP地址'),
            'user_agent' => Yii::t('rbac-admin', '用户浏览器'),
            'updated_at' => Yii::t('rbac-admin', '创建时间'),
            'created_at' => Yii::t('rbac-admin', '修改时间'),
        ];
    }

    public function getAdmin()
    {
        $model = new $this->userClassName;
        return $this->hasOne($model::className(), ['id' => 'admin_id']);
    }
}