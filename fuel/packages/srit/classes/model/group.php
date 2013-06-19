<?php
/**
 * @created 11.03.13 - 08:45
 * @author stefanriedel
 */

namespace Srit;

use Srit\Model;

class Model_Group extends \CachedModel {

    protected static $_many_many = array(
        'roles' => array(
            'model_to' => '\Model_Role',
        ),

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

    public static function find_guest() {
        $options = array('where' => array('name' => 'guest'));
        return static::find('first', $options);
    }

}