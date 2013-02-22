<?php

/**
 * @created 15.02.2013
 * @author stefanriedel
 */

namespace Srit;

class Debug extends \Fuel\Core\Debug {
    public static function ret_dump() {
        ob_start();
        parent::dump(func_get_args());
        return ob_get_clean();
    }
}