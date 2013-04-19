<?php
/**
 * @created 25.03.13 - 13:13
 * @author stefanriedel
 */

/**
 * @todo build if we need navigations dynamicly
 */

namespace Srit;

class Model_Navigation extends \Nestedsets\Model {



    const IS_ROOT_TRUE = true;
    const IS_ROOT_FALSE = false;

    protected static $_table_name = 'navigation';

    public static $tree = array(
        'left_field'     => 'left_id',
        'right_field'    => 'right_id',
        'tree_field'     => 'tree_id',
        'tree_value'     => null,
        'title_field'    => null,
        'symlink_field'  => 'symlink_id',
        'use_symlinks'   => false,
    );

    public static function find_namespaces() {
        return static::find_all(array(
           'where' => array(
               array('namespace', '!=', '')
           )
        ));
    }

    public static function find_namespaced_tree($namespace){

        $navigation = static::forge();
        $navigation->tree_select($namespace->tree_id);
        $root = $navigation->tree_get_root();
        if($root != null) {
            $data = static::_iterate_navigation_tree($root, self::IS_ROOT_TRUE);

        }
        return $data;
    }

    protected static function _iterate_navigation_tree($tree, $is_root = false) {
        $exchange = array();
        $cildren = $tree->tree_get_children();
        foreach($cildren as $child) {
            $element = $child->to_array();
            if($child->tree_has_children()) {
                $element['links'] = static::_iterate_navigation_tree($child);
            }
            if(!empty($element['named_params'])) {
                $element['named_params'] = unserializer($element['named_params']);
            }
            $element_name = $element['name'];
            $exchange = array_merge($exchange, array($element_name => $element));
        }

        return $exchange;
    }




}