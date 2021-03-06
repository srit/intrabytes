<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Core;

class Model_Country extends \CachedModel {
    /**protected static $_properties = array(
        'id',
        'iso_code',
        'name' => array(
            'localized' => true
        ),
        'language_id'
    );**/

    protected static $_has_many = array(
        'postalcodes' => array(
            'model_to' => '\Model_Postalcode'
        )
    );

    protected static $_belongs_to = array(
        'language' => array(
            'model_to' => '\Model_Language'
        )
    );

    protected static $_observers = array(
        '\Observer_Translated' => array(
            'properties' => array('name')
        )
    );

    public static function find($id = null, array $options = array())
    {
        $options = array_merge_recursive($options, array('order_by' => array('sort' => 'ASC')));
        return parent::find($id, $options); // TODO: Change the autogenerated stub
    }


    public static function find_all_for_html_select(array $options = array()) {
        $items = static::find_all($options);
        $ret_items = \Arr::assoc_to_keyval($items, 'id', 'name');
        return $ret_items;
    }
    
    public static function find_by_iso_code($iso_code) {
        $options = array('where' => array('iso_code' => $iso_code));
        return static::find('first', $options);
    }
    
}