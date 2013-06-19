<?php
/**
 * @created 13.06.13 - 16:08
 * @author stefanriedel
 */

namespace Srit;

class Router extends \Fuel\Core\Router {
    public static function get_route($name) {
        return isset(static::$routes[$name]) ? static::$routes[$name] : null;
    }
}