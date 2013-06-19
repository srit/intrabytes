<?php
/**
 * @created 03.06.13 - 21:08
 * @author stefanriedel
 */


namespace Srit;

class Observer_UpdatedAt extends \Orm\Observer_UpdatedAt
{
    public function __construct($class)
    {
        parent::__construct($class);
        $props = $class::observers('\\Observer_UpdatedAt');
        $this->_mysql_timestamp = isset($props['mysql_timestamp']) ? $props['mysql_timestamp'] : static::$mysql_timestamp;
        $this->_property = isset($props['property']) ? $props['property'] : static::$property;
    }


}