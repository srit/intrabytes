<?php
/**
 * @created 21.03.13 - 13:39
 * @author stefanriedel
 */

namespace Srit;

class Navigation_Elements implements \Iterator {

    protected $_elements = array();

    public function __construct($_data) {
        $this->_elements = $_data;
    }

    public function rewind()
    {
        $this->_pointer = 0;
        return $this;
    }

    /**
     * @return Navigation_Element
     */
    public function current()
    {
        $cur = current($this->_elements);
        return new Navigation_Element($cur);
    }

    public function key()
    {
        return key($this->current());
    }

    public function next()
    {
        return next($this->_elements);
    }

    public function valid()
    {
        return key($this->_elements) !== null;
    }
}