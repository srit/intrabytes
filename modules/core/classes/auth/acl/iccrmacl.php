<?php
/**
 * @created 12.03.13 - 20:47
 * @author stefanriedel
 */

namespace Core;

use Auth\Auth;
use Auth\Auth_Acl_Driver;
use Users\Model_Acl;
use Users\Model_Role;

class Auth_Acl_ICCRMAcl extends Auth_Acl_Driver
{
    public function has_access($condition, array $entity)
    {
        $group = Auth::group();
        $condition = self::_parse_conditions($condition);
        if (!is_array($condition) || empty($group) || !is_callable(array($group, 'get_roles'))) {
            return false;
        }

        $area = $condition[0];
        $rights = (array)$condition[1];
        $current_roles = $group->get_roles($entity[0]);
        $current_rights = array();
        $acl_array = array();
        if (is_array($current_roles)) {
            $roles = Model_Role::find_all();
            if (empty($roles)) {
                return false;
            }
            foreach ($roles as $role) {
                $acl_array[$role->name] = array();
                if (!empty($role->acls)) {
                    $i = 0;
                    foreach ($role->acls as $acl) {
                        //wildcard areas
                        if(!empty($acl->area)) {
                            $area = $acl->area;
                        }

                        if (!isset($acl_array[$role->name][$area])) {
                            $acl_array[$role->name][$area] = array();
                        }
                        $acl_array[$role->name][$area][] = $acl->right;

                    }
                }
            }

            foreach ($current_roles as $r_role) {
                if (!array_key_exists($r_role->name, $acl_array)) {
                    continue;
                }
                $r_rights = $acl_array[$r_role->name];

                // if one of the roles has a negative or positive wildcard return it
                if (is_bool($r_rights)) {
                    return $r_rights;
                } elseif (array_key_exists($area, $r_rights)) {
                    $current_rights = array_unique(array_merge($current_rights, $r_rights[$area]));
                }
            }

        }

        foreach ($rights as $right)
        {
            if ( ! in_array($right, $current_rights))
            {
                return false;
            }
        }

        return true;

    }
}