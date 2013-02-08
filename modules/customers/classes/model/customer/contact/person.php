<?php
/**
 * @created 06.02.13 - 15:46
 * @author stefanriedel
 */

namespace Customers;
use \Srit\Model;

class Model_Customer_Contact_Person extends Model {

    protected static $_table_name = 'customer_contact_persons';

    protected static $_properties = array(
        'id',
        'email',
        'lastname',
        'firstname',
        'salutation',
        'phone',
        'fax',
        'street',
        'housenumber',
        'postalcode_id',
        'customer_id',
        'created_at',
        'updated_at'
    );

    protected static $_belongs_to = array(
        'customer',
        'postalcode' => array(
            'model_to' => 'Srit\Model_Postalcode'
        )
    );
}