<?php
/**
 * @created 21.03.13 - 10:26
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Config;

class Navigation
{

    protected static $_instances = array();

    protected $_nav_data_array = array();

    protected $_elements;

    protected $_name = 'default';

    /**
     * @param string $name
     * @return Navigation
     */
    public static function forge($name = 'default')
    {
        if (!isset(static::$_instances[$name])) {
            static::$_instances[$name] = new static($name);
        }
        return static::$_instances[$name];
    }

    public function __construct($name = 'default')
    {
        Config::load('navigation', true);
        $this->_nav_data_array = Config::get('navigation.' . $name);
        $this->_name = $name;

        if(!empty($this->_nav_data_array)) {
            $this->_elements = new Navigation_Elements($this->_nav_data_array);
        }
    }

    /**
     * @return Navigation_Elements
     */
    public function getElements() {
        return $this->_elements;
    }

}