<?php
/**
 * @created 21.03.13 - 13:39
 * @author stefanriedel
 */

namespace Srit;

class Navigation_Elements implements \Iterator, \Countable
{

    protected $_elements = array();

    public function __construct($_data)
    {
        $this->_elements = $_data;
        $this->_initNavigationElement();
    }

    protected function _initNavigationElement()
    {
        foreach ($this->_elements as $name => $element) {
            $this->_elements[$name] = new Navigation_Element($element, $name);
            if ($this->_elements[$name]->hasChildren()) {
                $this->_elements[$name]['links'] = new Navigation_Elements($this->_elements[$name]->getChildren());
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
        $name = $this->key();
        $cur = current($this->_elements);
        $cur_element = new Navigation_Element($cur);
        $cur_element->setName($name);
        return $cur_element;
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