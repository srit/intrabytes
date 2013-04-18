<?php

/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */#

namespace Fuel\Tasks;

use Fuel\Core\Cli;
use Fuel\Core\Config;
use Srit\Model_Navigation;

class Navigation {

    static $_navigation = array();

    public static function run() {
        $install = Cli::option('install', Cli::option('i'));
        $remove = Cli::option('remove', Cli::option('r'));

        if (!empty($install)) {
            static::install();
        }
        if(!empty($remove)) {
            /**
             * @todo
             */
        }
    }

    public static function install() {
        static::$_navigation = Config::load('navigation');
        if(!empty(static::$_navigation)) {
            static::_iterate_navigation_tree(static::$_navigation);
        }
    }

    protected static function _iterate_navigation_tree(array $navigation_tree, Model_Navigation $navigation = null) {
        foreach($navigation_tree as $key => $nav) {
            if(is_array($nav) && !isset($nav['module']) && !isset($nav['controller_name']) && !isset($nav['action']) && !isset($nav['route'])) {
                //neuer navigations baum
                $new_tree = Model_Navigation::forge(array('namespace' => $key, 'name' => $key));
                $new_tree->tree_new_root();
                static::_iterate_navigation_tree($nav, $new_tree);
            } elseif(is_array($nav) && ((isset($nav['module']) && isset($nav['controller_name']) && isset($nav['action'])) || isset($nav['route']) )) {
                $forge_data = $nav;
                unset($forge_data['links']);
                if(isset($forge_data['named_params'])) {
                    $forge_data['named_params'] = serializer($forge_data['named_params']);
                }
                $forge_data['name'] = $key;
                $tree = Model_Navigation::forge($forge_data);
                $tree->tree_new_last_child_of($navigation);
                if(isset($nav['links'])) {
                    static::_iterate_navigation_tree($nav['links'], $tree);
                }
            }
        }
    }

}