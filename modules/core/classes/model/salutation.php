<?php
/**
 * @created 05.02.13 - 12:16
 * @author stefanriedel
 */

namespace Core;


class Model_Salutation extends \CachedModel
{
    /**protected static $_properties = array(
        'id',
        'salutation' => array(
            'type' => 'translated',
        )
    );**/

    protected static $_has_many = array(
        'customers' => array(
            'model_to' => '\Model_Customer'
        ),
        'customer_projects' => array(
            'model_to' => '\Model_Customer_Project'
        ),
    );

    protected static $_observers = array(
        '\\Observer_Translated' => array(
            'properties' => array('salutation')
        )
    );

    public static function find_all_for_html_select(array $options = array())
    {
        $items = static::find_all($options);
        $ret_items = \Arr::assoc_to_keyval($items, 'id', 'salutation');
        return $ret_items;
    }
}