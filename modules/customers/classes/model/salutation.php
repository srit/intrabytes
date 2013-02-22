<?php
/**
 * @created 05.02.13 - 12:16
 * @author stefanriedel
 */

namespace Customers;
use\Srit\Model;

class Model_Salutation extends Model {
    protected static $_properties = array(
        'id',
        'salutation' => array(
            'localized' => true,
        )
    );
    
    protected static $_has_many = array(
        'customers',
        'customer_projects',
    );
    
    public static function find_all_for_html_select(array $options = array()) {
        $items = static::find_all($options);
        $ret_items = \Fuel\Core\Arr::assoc_to_keyval($items, 'id', 'salutation');
        return $ret_items;
    }
}