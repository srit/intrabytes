<?php
/**
 * @created 02.04.13 - 08:24
 * @author stefanriedel
 */

namespace Srit;


class Uri extends \Fuel\Core\Uri {

    /**
     * the current uri with get parameters
     * @return string
     */
    public static function current()
    {
        return static::create(null, array(), \Input::get());
    }
}