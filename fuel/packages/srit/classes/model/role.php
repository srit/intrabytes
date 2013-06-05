<?php
/**
 * @created 11.03.13 - 08:45
 * @author stefanriedel
 */

namespace Srit;

use Srit\Model;

class Model_Role extends \CachedModel {


    protected static $_many_many = array(
        'groups' => array(
            'model_to' => '\Model_Group',
        ),
        'acls' => array(
            'model_to' => '\Model_Acl',
            'table_through' => 'acls_roles'
        )
    );

    protected static $_observers = array(
        '\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        '\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
    );

    public static function find($id = null, array $options = array()) {
        $tmp_options = array(
            'related' => array(
                'acls'
            )
        );
        $options = array_merge_recursive($tmp_options, $options);
        return parent::find($id, $options);
    }
}