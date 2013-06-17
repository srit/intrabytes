<?php
/**
 * @created 26.05.13 - 21:46
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Fuel;

class Srit extends \Fuel\Core\Fuel
{
    public static function init($config)
    {
        parent::init($config);
        \Lang::init();
        \Config::load('logger', true);
        //\Module::init_modules();
    }

    public static function always_load($array = null)
    {
        parent::always_load($array);
        \Module::init_modules();
    }

    public static function init_logger() {
        \Logger::forge();
    }

}