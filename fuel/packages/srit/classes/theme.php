<?php
/**
 * @created 22.11.12 - 14:54
 * @author stefanriedel
 */

namespace Srit;

class Theme extends \Fuel\Core\Theme
{

    protected $_templates_path_prefix = '';

    public function set_templates_path_prefix($templates_path_prefix)
    {
        $this->_templates_path_prefix = $templates_path_prefix;
        return $this;
    }

    public function get_templates_path_prefix()
    {
        return $this->_templates_path_prefix;
    }

    public static function clear($name = '_default_')
    {
        if(isset(static::$instances[$name])) {
            unset(static::$instances[$name]);
        }
    }

}