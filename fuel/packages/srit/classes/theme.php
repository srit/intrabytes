<?php
/**
 * @created 22.11.12 - 14:54
 * @author stefanriedel
 */

namespace Srit;

class Theme extends \Fuel\Core\Theme
{
    public static function clear($name = '_default_')
    {
        if(isset(static::$instances[$name])) {
            unset(static::$instances[$name]);
        }
    }
}