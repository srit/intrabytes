<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Srit;
use \Srit\Model;

class Model_Postalcode extends Model {
    protected static $_properties = array(
        'id',
        'postalcode',
        'city',
        'country_id'
    );

    protected static $_belongs_to = array(
        'country'
    );
}