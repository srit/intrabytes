<?php
/**
 * @created 21.03.13 - 13:39
 * @author stefanriedel
 */

namespace Srit;

class Navigation_Elements implements \Iterator, \Countable
{

    protected $_elements = array();

    /**
     * @var Navigation_Element
     */
    protected $_parent = null;

    public function __construct($_data, $_parent = null)
    {
        if($_parent != null) {
            $this->setParent($_parent);
        }
        $this->_elements = $_data;
        $this->_initNavigationElement();
    }

    public function hasParent() {
        return ($this->_parent instanceof Navigation_Element);
    }

    public function setParent(Navigation_Element $parent) {
        $this->_parent = $parent;
    }

    public function getParent() {
        return $this->_parent;
    }

    protected function _initNavigationElement()
    {
        foreach ($this->_elements as $name => $element) {
            $this->_elements[$name] = new Navigation_Element($element, $name, $this->getParent());
            if ($this->_elements[$name]->hasChildren()) {
                $this->_elements[$name]['links'] = new Navigation_Elements($this->_elements[$name]->getChildren(), $this->_elements[$name]);
                //$this->_elements[$name]['links'] = $this->_initNavigationElement($this->_elements[$name]->getChildren());
            }
        }

    }

    /***************************************************************************
     * Implementation of Iterable
     **************************************************************************/
    public function rewind()
    {
        return $this;
    }

    /**
     * @return Navigation_Element
     */
    public function current()
    {
        return current($this->_elements);
    }

    public function key()
    {
        return key($this->_elements);
    }

    public function next()
    {
        return next($this->_elements);
    }

    public function valid()
    {
        return key($this->_elements) !== null;
    }

    public function count()
    {
        return count($this->_elements);
    }
}