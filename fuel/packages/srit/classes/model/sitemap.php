<?php
/**
 * @created 25.03.13 - 13:13
 * @author stefanriedel
 */

/**
 * @todo build if we need navigations dynamicly
 */

namespace Srit;

class Model_Sitemap extends \Nestedsets\Model {

    protected static $_table_name = 'sitemap';

    protected static $_properties = array(
        'id',
        'left_id',
        'right_id',
        'symlink_id',
        'tree_id',
        'acl',
        'route_name',
        'namespace'
    );

    public static $tree = array(
        'left_field'     => 'left_id',
        'right_field'    => 'right_id',
        'tree_field'     => 'tree_id',
        'tree_value'     => null,
        'title_field'    => null,
        'symlink_field'  => 'symlink_id',
        'use_symlinks'   => false,
    );
}