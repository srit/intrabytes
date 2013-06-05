<?php
/**
 * @created 03.06.13 - 21:08
 * @author stefanriedel
 */


namespace Srit;

class Observer_Slug extends \Orm\Observer_Slug {
    public function __construct($class)
    {
        parent::__construct($class);
        $props = $class::observers('\\Observer_Slug');
        $this->_source    = isset($props['source']) ? $props['source'] : static::$source;
        $this->_property  = isset($props['property']) ? $props['property'] : static::$property;
    }

}