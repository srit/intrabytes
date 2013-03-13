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

class Auth_Acl_ICCRMAcl extends Auth_Acl_Driver {
    public function has_access($condition, array $entity) {
        $group = Auth::group();
        $condition = self::_parse_conditions($condition);
        if(!is_array($condition) || empty($group) || !is_callable(array($group, 'get_roles'))) {
            return false;
        }

        $area    = $condition[0];
        $rights  = (array)$condition[1];
        $current_roles  = $group->get_roles($entity[0]);
        $current_rights = array();
        $acl_array = array();
        if(is_array($current_roles)) {
            $roles = Model_Role::find_all();
            if(empty($roles)) {
                return false;
            }
            foreach($roles as $role) {
                $acl_array[$role->name] = array();
                if(!empty($role->acls)) {
                    foreach($role->acls as $acl) {
                        $acl_array[$role->name]
                    }
                }
            }
        }
    }
}