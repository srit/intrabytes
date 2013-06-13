<?php
/**
 * @created 26.05.13 - 21:46
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Fuel;

class Srit
{
    public static function init()
    {
        \Module::init_modules();
    }

    public static function init_logger() {
        \Logger::forge();
    }

}