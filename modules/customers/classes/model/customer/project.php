<?php
/**
 * @created 06.02.13 - 15:48
 * @author stefanriedel
 */

namespace Customers;
use \Srit\Model;

class Model_Customer_Project extends Model {
    protected static $_properties = array(
        'id',
        'name',
        'customer_id',
        'created_at',
        'updated_at'
    );

    protected static $_belongs_to = array(
        'customer'
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