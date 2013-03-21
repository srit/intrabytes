<?php
/**
 * @created 21.03.13 - 10:26
 * @author stefanriedel
 */

namespace Srit;

use Core\Theme;
use Fuel\Core\Config;

class Navigation
{

    protected static $_instances = array();

    protected $_nav_data_array = array();

    /**
     * @var Navigation_Elements
     */
    protected $_elements;

    protected $_name = 'default';

    protected $_rendered = '';

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
        return new $this->_elements;
    }

    public function render($max_depth = null, $force = false) {
        if($force == true || (count($this->_elements) > 0 && $this->_rendered == '')) {
            $this->_rendered = $this->_render_elements($this->_elements);
        }

        Theme::instance()->get_template()->set_global($this->_name, $this->_rendered);

        return $this->_rendered;
    }

    /**
     * @param Navigation_Elements $elements
     * @param int $depth
     */
    protected function _render_elements(Navigation_Elements $elements, $depth = 0) {
        foreach($elements as $element) {
            if($element->hasChildren()) {
                $this->_render_elements($element->getChildren(), ++$depth);
            } else {
                $this->_render_element($element);
            }
        }
    }

    protected function _render_element($element) {
    }

}