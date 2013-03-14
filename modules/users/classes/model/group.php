<?php
/**
 * @created 11.03.13 - 08:45
 * @author stefanriedel
 */

namespace Users;

use Srit\Model;

class Model_Group extends Model {
    protected static $_properties = array(
        'id',
        'name',
        'points',
        'created_at',
        'updated_at'
    );

    protected static $_many_many = array(
        'roles'
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
}