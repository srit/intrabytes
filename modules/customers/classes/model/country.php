<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Customers;
use \Srit\Model;

class Model_Country extends Model {
    protected static $_properties = array(
        'id',
        'iso_code',
        'name',
        'language_id'
    );

    protected static $_has_many = array(
        'postalcodes'
    );

    protected static $_belongs_to = array(
        'language' => array(
            'model_to' => '\Srit\Model_Language'
        )
    );
    
    public static function find_all_for_html_select(array $options = array()) {
        $items = static::find_all($options);
        $ret_items = \Fuel\Core\Arr::assoc_to_keyval($items, 'id', 'name');
        return $ret_items;
    }
    
    public static function find_by_iso_code($iso_code) {
        $options = array('where' => array('iso_code' => $iso_code));
        return static::find('first', $options);
    }
    
}