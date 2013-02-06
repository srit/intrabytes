<?php
/**
 * @created 05.02.13 - 12:16
 * @author stefanriedel
 */

namespace Customers;
use \Srit\Model;

class Model_Customer extends Model {
    protected static $_properties = array(
        'id',
        'created_at',
        'updated_at',
        'email',
        'company_name',
        'firstname',
        'lastname',
        'salutation',
        'phone',
        'fax',
        'street',
        'housenumber',
        'postalcode_id'
    );

    protected static $_has_many = array(
        'customer_contact_person' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        )
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