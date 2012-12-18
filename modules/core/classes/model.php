<?php
/**
 * @created 09.11.12 - 11:26
 * @author stefanriedel
 */

namespace Core;

class Model extends \Orm\Model
{

    protected static $_many_many = array();
    protected static $_belongs_to = array();
    protected static $_has_one = array();
    protected static $_has_many = array();


    public static function add_relation(array $relation)
    {
        \Fuel\Core\Debug::dump($relation);
        foreach ($relation as $type => $rel) {
            if (isset(static::$_{$type})) {
                static::$_{$type} += $rel;
            }
        }
        $class = get_called_class();
        if (array_key_exists($class, static::$_relations_cached)) {
            unset(static::$_relations_cached[$class]);
        }
    }

}