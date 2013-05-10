<?php
/**
 * @created 11.03.13 - 08:45
 * @author stefanriedel
 */

namespace Users;

use Srit\Model;

class Model_Role extends Model {
    protected static $_properties = array(
        'id',
        'name',
        'created_at',
        'updated_at'
    );

    protected static $_many_many = array(
        'groups',
        'acls'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_UpdatedAt' => array(
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