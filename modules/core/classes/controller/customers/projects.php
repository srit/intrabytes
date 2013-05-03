<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_Base_User;

class Controller_Customers_Projects extends Controller_Base_User {

    protected $_crud_objects = array(
        'customer_project' => array()
    );

}