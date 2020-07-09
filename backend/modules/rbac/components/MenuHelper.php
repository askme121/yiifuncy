<?php

namespace rbac\components;

use Yii;
use rbac\models\Rule;
use rbac\models\Role;

class MenuHelper
{
    public static function getAuthMenu($userId, $root = 0, $callback = null, $refresh = false)
    {
        $role_id = Yii::$app->user->identity->role_id;
        $purview = Role::find()->where(['id'=>$role_id])->one()->purview;
        $menus = Rule::find()->andWhere(['<>','type', 3])->andWhere(['in', 'id', $purview])->asArray()->indexBy('id')->all();
        $query = Rule::find()->andWhere(['<>','type', 3])->andWhere(['in', 'id', $purview])->select(['id'])->asArray();
        $assigned = $query->column();
        $assigned = static::requiredParent($assigned, $menus);
        $result = static::normalizeMenu($assigned, $menus, $callback, $root);
        return $result;
    }

    private static function requiredParent($assigned, &$menus)
    {
        $l = count($assigned);
        for ($i = 0; $i < $l; $i++) {
            $id = $assigned[$i];
            $parent_id = $menus[$id]['parent'];
            if ($parent_id>0 && !in_array($parent_id, $assigned)) {
                $assigned[$l++] = $parent_id;
            }
        }
        return $assigned;
    }

    public static function parseRoute($route)
    {
        if (!empty($route)) {
            $url = [];
            $r = explode('&', $route);
            $url[0] = $r[0];
            unset($r[0]);
            foreach ($r as $part) {
                $part = explode('=', $part);
                $url[$part[0]] = isset($part[1]) ? $part[1] : '';
            }
            return $url;
        }
        return '#';
    }

    private static function normalizeMenu(&$assigned, &$menus, $callback, $parent = 0)
    {
        $result = [];
        $order = [];
        foreach ($assigned as $id) {
            $menu = $menus[$id];
            if ($menu['parent'] == $parent) {
                $menu['children'] = static::normalizeMenu($assigned, $menus, $callback, $id);
                if ($callback !== null) {
                    $item = call_user_func($callback, $menu);
                } else {
                    $item = [
                        'label' => Yii::t('rbac-admin',$menu['name']),
                        'url' => static::parseRoute($menu['route']),
                    ];
                    if ($menu['children'] != []) {
                        $item['items'] = $menu['children'];
                    }
                }
                $result[] = $item;
                $order[] = $menu['order'];
            }
        }
        if ($result != []) {
            array_multisort($order, $result);
        }
        return $result;
    }
}
