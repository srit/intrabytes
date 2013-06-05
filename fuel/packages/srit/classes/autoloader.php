<?php
/**
 * @created 29.05.13 - 13:50
 * @author stefanriedel
 */

namespace Srit;

class Autoloader extends \Fuel\Core\Autoloader
{
    public static function get_classes()
    {
        return static::$classes;
    }

    public static function get_namespaces()
    {
        return static::$namespaces;
    }

    public static function get_core_namespaces() {
        return static::$core_namespaces;
    }
}