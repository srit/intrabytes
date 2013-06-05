<?php
/**
 * @created 06.02.13 - 15:46
 * @author stefanriedel
 */

namespace Core;

use Srit\CachedModel;

class Model_Customer_Contact extends \CachedModel {

    //protected static $_table_name = 'customer_contact_persons';
    protected static $_belongs_to = array(
        'postalcode' => array(
            'model_to' => '\Model_Postalcode'
        ),
        'salutation' => array(
            'model_to' => '\Model_Salutation'
        ),
        'customer' => array(
            'modelt_to' => '\Model_Customer'
        )
    );
}