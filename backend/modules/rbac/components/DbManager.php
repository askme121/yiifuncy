<?php

namespace rbac\components;

use Yii;
use yii\db\Query;
use common\models\Config;
use common\models\Site;

class DbManager
{
    private $_assignments = [];
    private $_checkAccessAssignments = [];
    protected $items;
    public $defaultRoles = ['guest'];
    public $db;
    public $itemTable = '{{%auth_rule}}';

    public function init()
    {
        $this->db = Yii::$app->getDb();
    }

    public function getAssignments($userId)
    {
        if (!isset($this->_assignments[$userId])) {
            $this->_assignments[$userId] = $this->getMainAssignments($userId);
        }
        return $this->_assignments[$userId];
    }

    public function getMainAssignments($userId)
    {
        if ($this->isEmptyUserId($userId)) {
            return [];
        }

        $query = (new Query())
            ->from($this->itemTable)
            ->where(['type' => 2]);

        $assignments = [];
        foreach ($query->all($this->db) as $row) {
            $assignments[$row['name']] = $row;
        }
        return $assignments;
    }

    protected function isEmptyUserId($userId)
    {
        return !isset($userId) || $userId === '';
    }

    public function checkAccess($userId, $permissionName, $params = [])
    {
        $session_default_site_id = \Yii::$app->session['default_site_id'];
        if (empty($session_default_site_id)) {
            $default_site =  Config::getConfig('default_site');
            if ($default_site) {
                $default_site_id = Site::findOne(['code' => $default_site])->id;
                if ($default_site_id) {
                    \Yii::$app->session['default_site_id'] = $default_site_id;
                }
            }
        }
        if (isset($this->_checkAccessAssignments[(string) $userId])) {
            $assignments = $this->_checkAccessAssignments[(string) $userId];
        } else {
            $assignments = $this->getAssignments($userId);
            $this->_checkAccessAssignments[(string) $userId] = $assignments;
        }

        if ($this->hasNoAssignments($assignments)) {
            return false;
        }
        return true;
    }

    protected function hasNoAssignments(array $assignments)
    {
        return empty($assignments) && empty($this->defaultRoles);
    }
}
