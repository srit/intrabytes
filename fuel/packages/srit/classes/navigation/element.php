<?php
/**
 * @created 21.03.13 - 14:21
 * @author stefanriedel
 */

namespace Srit;

use Fuel\Core\Uri;

class Navigation_Element implements \ArrayAccess{

    protected $_data = array();

    protected $_has_childs = false;

    protected $_name = '';

    public function set($property, $value) {
        $this->_data[$property] = $value;
    }

    public function & get($property) {
        return $this->_data[$property];
    }

    public function & __get($property) {
        return $this->get($property);
    }

    public function __set($property, $value) {
        $this->set($property, $value);
    }

    public function __isset($property) {
        return (isset($this->_data[$property]));
    }

    public function __unset($property) {
        unset($this->_data[$property]);
    }

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function __construct($_data, $name = null) {
        $this->_data = $_data;
        $this->_name = $name;
        $this->init();
    }

    public function init() {
        $this->_chckIsActive();
    }

    protected function _chckIsActive() {
        $current_uri = Uri::current();
        var_dump($current_uri);
    }

    public function hasChildren() {
        $this->_has_childs = (isset($this->_data['links']) && is_array($this->_data['links']));
        return $this->_has_childs;
    }

    public function setChildren(Navigation_Elements $childs) {
        $this->_children = $childs;
        return $this;
    }

    public function getChildren() {
        return $this->_data['links'];
    }


    /***************************************************************************
     * Implementation of ArrayAccess
     **************************************************************************/

    public function offsetSet($offset, $value)
    {
        $this->__set($offset,$value);
    }

    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }


}