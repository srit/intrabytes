<?php
/**
 * @created 21.03.13 - 10:26
 * @author stefanriedel
 */

namespace Srit;

class Navigation
{

    protected static $_instances = array();

    /**
     * @var Navigation
     */
    protected static $_instance = null;

    protected static $_nav_data_array = array();

    protected static $_navigation_namespaces = null;

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
        if (static::$_nav_data_array == array()) {


            static::$_navigation_namespaces = \Model_Navigation::find_namespaces();
            if(static::$_navigation_namespaces != null) {
                static::$_nav_data_array = \Model_Navigation::find_trees();
            }
        }

        if($name != null) {
            /**if($name == 'top_right') {
                var_dump(static::$_nav_data_array[$name]);
            }**/
            $this->_name = $name;
        }
        $this->_initNavigationElements();
    }




    public function find_active()
    {
        if (!empty($this->_elements)) {
            foreach ($this->_elements as $elements) {
                $this->_active_elements = $this->_find_active_elements($elements);
                if ($this->_active_elements != array()) {
                    break;
                }
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
                if ($element->hasChildren()) {
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
        if($this->_name != null) {
            $this->_elements[$this->_name] = new \Navigation_Elements(static::$_nav_data_array[$this->_name]);
        } else {
            foreach (static::$_nav_data_array as $level => $elements) {
                $this->_elements[$level] = new \Navigation_Elements($elements);
            }
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

        if (!empty($this->_name) && isset($this->_elements[$this->_name]) && $this->_elements[$this->_name] instanceof \Navigation_Elements) {
            $this->_rendered = get_theme_instance()->view('templates/_partials/navigation/' . $this->_name)->set('elements', $this->_elements[$this->_name], false);
        }

        return $this->_rendered;
    }

    public function render_breadcrumb()
    {
        if (empty($this->_active_elements)) {
            $this->find_active();
        }

        $base_route = base_route();
        $null_element = isset($this->_active_elements[0]) ? $this->_active_elements[0] : null;

        if (!empty($this->_active_elements) AND $null_element != null AND $null_element->get_route() != $base_route AND (isset(\Router::$routes['_root_']) AND \Uri::create(\Router::$routes['_root_']->translation) != $null_element->get_route())) {
            $startseite = new \Navigation_Element(array(
                'route' => base_route(),
                //'acl' => 'Customers\\Show.index',
                'show' => false
            ), 'home');
            array_unshift($this->_active_elements, $startseite);

        }

        $this->_rendered_breadcrumb = \Theme::instance()->view('templates/_partials/navigation/breadcrumb')->set('breadcrumb_elements', $this->_active_elements, false);
        return $this->_rendered_breadcrumb;
    }

    /**
     * @param Navigation_Elements $elements
     * @param int $depth
     */
    protected function _render_elements(\Navigation_Elements $elements, $depth = 0)
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

    public function get_tree($name) {

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