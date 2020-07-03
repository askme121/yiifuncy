<?php

namespace rbac\components;

use Yii;
use yii\rbac\Permission;
use yii\rbac\Role;
use yii\rbac\Item;
use yii\db\Query;

class DbManager
{
    private $_assignments = [];
    private $_checkAccessAssignments = [];
    protected $items;
    public $defaultRoles = ['guest'];
    public $db;
    public $itemTable = '{{%auth_item}}';

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
            ->where(['type' => (string) Item::TYPE_PERMISSION]);

        $assignments = [];
        foreach ($query->all($this->db) as $row) {
            $assignments[$row['name']] = $row;
        }
        return $assignments;
    }

    public function getPermissions()
    {
        return $this->getItems(Item::TYPE_PERMISSION);
    }

    protected function getItems($type)
    {
        $query = (new Query())
            ->from($this->itemTable)
            ->where(['type' => $type]);
        $items = [];
        foreach ($query->all($this->db) as $row) {
            $items[$row['name']] = $this->populateItem($row);
        }
        return $items;
    }

    public function getRole($name)
    {
        $item = $this->getItem($name);
        return $item instanceof Item && $item->type == Item::TYPE_ROLE ? $item : null;
    }

    public function getPermission($name)
    {
        $item = $this->getItem($name);
        return $item instanceof Item && $item->type == Item::TYPE_PERMISSION ? $item : null;
    }

    protected function getItem($name)
    {
        if (empty($name)) {
            return null;
        }
        if (!empty($this->items[$name])) {
            return $this->items[$name];
        }
        $row = (new Query())->from($this->itemTable)
            ->where(['name' => $name])
            ->one($this->db);
        if ($row === false) {
            return null;
        }
        return $this->populateItem($row);
    }

    protected function populateItem($row)
    {
        $class = $row['type'] == Item::TYPE_PERMISSION ? Permission::className() : Role::className();
        if (!isset($row['data']) || ($data = @unserialize(is_resource($row['data']) ? stream_get_contents($row['data']) : $row['data'])) === false) {
            $data = null;
        }
        return new $class([
            'name' => $row['name'],
            'type' => $row['type'],
            'description' => $row['description'],
            'ruleName' => $row['rule_name'] ?: null,
            'data' => $data,
            'createdAt' => $row['created_at'],
            'updatedAt' => $row['updated_at'],
        ]);
    }

    protected function isEmptyUserId($userId)
    {
        return !isset($userId) || $userId === '';
    }

    public function createRole($name)
    {
        $role = new Role();
        $role->name = $name;
        return $role;
    }

    public function createPermission($name)
    {
        $permission = new Permission();
        $permission->name = $name;
        return $permission;
    }

    public function checkAccess($userId, $permissionName, $params = [])
    {
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
