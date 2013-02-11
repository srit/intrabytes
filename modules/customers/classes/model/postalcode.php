<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Customers;
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
    
    public static function find_by_postalcode($postalcode, array $options = array()) {
        $options = array_merge_recursive($options, array('where' => array('postalcode' => $postalcode)));
        $item = static::find('first', $options);
        return $item ? : false;
    }
}