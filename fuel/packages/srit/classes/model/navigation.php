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
}