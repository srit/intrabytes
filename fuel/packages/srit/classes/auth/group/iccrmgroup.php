<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.5
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Srit;

use Auth\Auth_Group_Driver;

class Auth_Group_ICCRMGroup extends Auth_Group_Driver
{

    public static $_valid_groups = array();

    public static function _init()
    {
        $groups = \Model_Group::find_all();
        foreach ($groups as $gr) {
            static::$_valid_groups[] = $gr->name;
        }
    }

    protected $config = array(
        'drivers' => array('acl' => array('\ICCRMAcl')),
    );

    public function get_name($group = null) {
        if ($group === null)
        {
            if ( !$login = \Auth::instance() or !is_array($groups = $login->get_groups()))
            {
                return false;
            }

            $group = isset($groups[0]) ? array_pop($groups[0]) : false;
        }

        return $group->get_name();
    }

    /**
     *
     * Check user is member of group $group
     *
     * @param $group
     * @param Model_User $user
     * @return bool
     */
    public function member($group, $user = null)
    {
        if ($user === null) {
            $groups = \Auth::instance()->get_groups();
        } else {
            $groups = \Auth::instance($user[0])->get_groups();
        }

        if (!$groups || !in_array($group, static::$_valid_groups)) {
            return false;
        }

        return array_key_exists_r($group, $groups);
    }

    public function get_roles($group = null)
    {
        if (!$login = \Auth::instance() or !is_array($groups = $login->get_groups()) or !isset($groups[0])) {
            return array();
        }
        // When group is empty, attempt to get groups from a current login
        if ($group === null) {
            $group = array_pop($groups[0]);
        } elseif (!in_array((int)$group, static::$_valid_groups)) {
            return array();
        } else {
            $group = array_pop($groups[0]);
        }

        return $group->get_roles();

    }
}
