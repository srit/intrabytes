<?php
/**
 * @created 21.03.13 - 10:26
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Config;
use Fuel\Core\Router;

class Navigation
{

    protected static $_instances = array();

    /**
     * @var Navigation
     */
    protected static $_instance = null;

    protected $_nav_data_array = array();

    /**
     * @var Navigation_Elements
     */
    protected $_elements = null;

    protected $_name = null;

    protected $_rendered = '';

    protected $_rendered_breadcrumb = '';

    protected $_active_elements = array();

    public static function instance()
    {
        if (static::$_instance == null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    /**
     * @param string $name
     * @return Navigation
     */
    public static function forge($name)
    {
        if (!isset(static::$_instances[$name])) {
            static::$_instances[$name] = new static($name);
        }
        return static::$_instances[$name];
    }

    public function __construct($name = null)
    {
        if ($this->_nav_data_array == array()) {
            if ($name == null) {
                $this->_nav_data_array = Config::load('navigation', true);
            } else {
                Config::load('navigation', true);
                $this->_nav_data_array[$name] = Config::get('navigation.' . $name);
                $this->_name = $name;
            }
            $this->_initNavigationElements();
        }
    }


    public function find_active()
    {
        foreach ($this->_elements as $elements) {
            $this->_active_elements = $this->_find_active_elements($elements);
            if($this->_active_elements != array()) {
                break;
            }
        }
        return $this->_active_elements;
    }

    protected function _find_active_elements($elements)
    {
        $active_elements = array();
        foreach ($elements as $element) {
            if ($element->active == true) {
                $active_elements[] = $element;
                if($element->hasChildren()) {
                    $active_elements = array_merge($active_elements, $this->_find_active_elements($element->getChildren()));
                }
            }
        }
        return $active_elements;
    }

    /**
     * now it provide one level deep
     *
     * @todo more deeper
     *
     * @param $element_name
     */
    public function find_element_level($element_name)
    {
        foreach ($this->_elements as $level => $element) {
            if (isset($element->{$element_name})) {
                return $level;
            }
        }
        return null;
    }

    protected function _initNavigationElements()
    {
        foreach ($this->_nav_data_array as $level => $elements) {
            $this->_elements[$level] = new Navigation_Elements($elements);
        }
    }

    /**
     * @return Navigation_Elements
     */
    public function getElements()
    {
        return $this->_elements;
    }

    public function render($max_depth = null, $force = false)
    {

        if (!empty($this->_name) && isset($this->_elements[$this->_name]) && $this->_elements[$this->_name] instanceof Navigation_Elements) {
            $this->_rendered = Theme::instance()->view('templates/_partials/navigation/' . $this->_name)->set('elements', $this->_elements[$this->_name], false);
        }

        return $this->_rendered;
    }

    public function render_breadcrumb() {
        if(empty($this->_active_elements)) {
            $this->find_active();
        }

        $base_route = base_route();
        $null_element = isset($this->_active_elements[0]) ? $this->_active_elements[0] : null;

        if(!empty($this->_active_elements) AND $null_element != null AND $null_element->get_route() != $base_route AND (isset(Router::$routes['_root_']) AND Uri::create(Router::$routes['_root_']->translation) != $null_element->get_route())) {
            $startseite = new Navigation_Element(array(
                'route' => base_route(),
                //'acl' => 'Customers\\Show.index',
                'show' => false
            ), 'home');
            array_unshift($this->_active_elements, $startseite);

        }

        $this->_rendered_breadcrumb = Theme::instance()->view('templates/_partials/navigation/breadcrumb')->set('breadcrumb_elements', $this->_active_elements, false);
        return $this->_rendered_breadcrumb;
    }

    /**
     * @param Navigation_Elements $elements
     * @param int $depth
     */
    protected function _render_elements(Navigation_Elements $elements, $depth = 0)
    {
        //var_dump($elements);

        /**foreach ($elements as $element) {
        if ($element->hasChildren()) {
        $this->_render_elements($element->getChildren(), ++$depth);
        } else {
        $this->_render_element($element);
        }
        }**/
    }

    protected function _render_element($element)
    {
    }

    public function __toString()
    {
        return $this->render();
    }

    public function get($property)
    {
        if (!empty($this->_name)) {
            if (isset($this->_elements[$this->_name]->{$property})) {
                return $this->_elements[$this->_name]->{$property};
            }
        } else {
            return $this->_elements[$property];
        }
    }

    public function __get($property)
    {
        return $this->get($property);
    }

}