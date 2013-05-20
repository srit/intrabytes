<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_CrudBigTemplate;

class Controller_Customers_Projects extends Controller_CrudBigTemplate {

    protected $_crud_objects = array(
        'customer_project' => array()
    );

}