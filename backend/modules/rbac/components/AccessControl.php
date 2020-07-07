<?php

namespace rbac\components;

use yii\web\ForbiddenHttpException;
use yii\base\Module;
use Yii;
use yii\web\User;
use yii\di\Instance;
use rbac\models\Log;

class AccessControl extends \yii\base\ActionFilter
{
    private $_user = 'user';
    public $allowActions = [];

    public function getUser()
    {
        if (!$this->_user instanceof User) {
            $this->_user = Instance::ensure($this->_user, User::className());
        }
        return $this->_user;
    }

    public function setUser($user)
    {
        $this->_user = $user;
    }

    public function beforeAction($action)
    {
        $actionId = $action->getUniqueId();
        $user = $this->getUser();
        if (Helper::checkRoute('/' . $actionId, Yii::$app->getRequest()->get(), $user)) {
            return true;
        }
        return true;
        //$this->denyAccess($user);
    }

    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }

    protected function isActive($action)
    {
        $uniqueId = $action->getUniqueId();
        if ($uniqueId === Yii::$app->getErrorHandler()->errorAction) {
            return false;
        }

        $user = $this->getUser();
        if($user->getIsGuest())
        {
            $loginUrl = null;
            if(is_array($user->loginUrl) && isset($user->loginUrl[0])){
                $loginUrl = $user->loginUrl[0];
                }else if(is_string($user->loginUrl)){
                    $loginUrl = $user->loginUrl;
                }
                if(!is_null($loginUrl) && trim($loginUrl,'/') === $uniqueId)
                {
                    return false;
                }
        }

        if ($this->owner instanceof Module) {
            // convert action uniqueId into an ID relative to the module
            $mid = $this->owner->getUniqueId();
            $id = $uniqueId;
            if ($mid !== '' && strpos($id, $mid . '/') === 0) {
                $id = substr($id, strlen($mid) + 1);
            }
        } else {
            $id = $action->id;
        }

        foreach ($this->allowActions as $route) {
            if (substr($route, -1) === '*') {
                $route = rtrim($route, "*");
                if ($route === '' || strpos($id, $route) === 0) {
                    return false;
                }
            } else {
                if ($id === $route) {
                    return false;
                }
            }
        }

        if ($action->controller->hasMethod('allowAction') && in_array($action->id, $action->controller->allowAction())) {
            return false;
        }

        return true;
    }

	public function afterAction($action, $result)
    {
		Log::addLog($action);
		return parent::afterAction($action, $result);
	}
}
