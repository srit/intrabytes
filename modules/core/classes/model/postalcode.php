<?php
/**
 * @created 06.02.13 - 15:58
 * @author stefanriedel
 */
namespace Core;

use Srit\CachedModel;

class Model_Postalcode extends CachedModel {
    protected static $_properties = array(
        'id',
        'postalcode',
        'city',
        'country_id'
    );

    protected static $_belongs_to = array(
        'country'
    );
    
    public static function find_by_postalcode($postalcode, $country_id, array $options = array()) {
        $options = array_merge_recursive($options, array('where' => array('postalcode' => $postalcode, 'country_id' => $country_id)));
        $item = static::find('first', $options);
        return $item ? : false;
    }
    
    public static function find_like_postalcode($postalcode, $country_id, array $options = array()) {
        $options = array_merge_recursive($options, array('where' => array(
            array('postalcode', 'LIKE', $postalcode . '%'),
            array('country_id', $country_id)
            )));
        $items = static::find_all($options);
        return $items ? : false;
    }
}