<?php
/**
 * @created 21.03.13 - 13:39
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\FuelException;

class Navigation_Elements implements \Iterator, \Countable
{

    protected $_elements = array();

    /**
     * @todo the original array
     */
    protected $_data_array = array();

    /**
     * @var Navigation_Element
     */
    protected $_parent = null;

    /**
     * @param array $_data
     * @param Navigation_Element $_parent
     *
     * @todo $_data is empty
     */
    public function __construct(array $_data, $_parent = null)
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
                $childrens = $this->_elements[$name]->getChildren();
                if(!$childrens instanceof Navigation_Elements) {
                    $this->_elements[$name]['links'] = new self($this->_elements[$name]->getChildren(), $this->_elements[$name]);
                } else {
                    $this->_elements[$name]['links'] = $childrens;
                }
                //$this->_elements[$name]['links'] = $this->_initNavigationElement($this->_elements[$name]->getChildren());
            }
        }

    }

    public function __isset($property) {
        return isset($this->_elements[$property]);
    }

    public function __get($property) {
        return $this->get($property);
    }

    public function get($property) {
        if(isset($this->_elements[$property])) {
            return $this->_elements[$property];
        }
    }

    public function addElement($name, array $data) {
        if(isset($this->_elements[$name])) {
            throw new FuelException(__('exception.srit.navigation_elements.addelement.element.exists'));
        }
        $this->_elements[$name] = new Navigation_Element($data, $name, $this->getParent());
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