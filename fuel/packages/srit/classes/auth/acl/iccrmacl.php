<?php
/**
 * @created 12.03.13 - 20:47
 * @author stefanriedel
 */

namespace Srit;


use Auth\Auth_Acl_Driver;

class Auth_Acl_ICCRMAcl extends Auth_Acl_Driver
{

    /**
     * @var Model_Role
     */
    protected $_roles = null;

    public function has_access($condition, array $entity)
    {
        $group = \Auth::group();
        $condition = static::_parse_conditions($condition);
        if (!is_array($condition) || empty($group) || !is_callable(array($group, 'get_roles'))) {
            return false;
        }

        $area = $condition[0];
        $rights = (array)$condition[1];
        $current_roles = $group->get_roles($entity[0]);
        $current_rights = array();
        $acl_array = array();
        if (is_array($current_roles)) {
            $this->_roles = \Model_Role::find_all();
            if (empty($this->_roles)) {
                return false;
            }

            foreach ($this->_roles as $role) {
                $acl_array[$role->get_name()] = array();
                if ($role->get_acls()) {
                    foreach ($role->get_acls() as $acl) {
                        if((bool)$acl->get_is_global()) {
                            $acl_array[$role->get_name()] = ($acl->get_right() == 'true' || (int)$acl->get_right() == 1) ? true : false;
                            continue;
                        }

                        //wildcard areas
                        if($acl->get_area() != NULL) {
                            $acl_area = $acl->get_area();
                        } else {
                            $acl_area = $area;
                        }

                        if (!isset($acl_array[$role->get_name()][$acl_area])) {
                            $acl_array[$role->get_name()][$acl_area] = array();
                        }
                        $acl_array[$role->get_name()][$acl_area][] = $acl->get_right();

                    }
                }
            }

            //Logger::forge('acl')->addDebug('ACL Array: ', array($acl_array));
            foreach ($current_roles as $r_role) {
                if (!array_key_exists($r_role->get_name(), $acl_array)) {
                    continue;
                }
                $r_rights = $acl_array[$r_role->get_name()];
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