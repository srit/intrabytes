<?php
/**
 * @created 21.03.13 - 14:21
 * @author stefanriedel
 */

namespace Srit;

use Auth\Auth;
use Fuel\Core\Uri;
use Oil\Exception;

class Navigation_Element implements \ArrayAccess{

    protected $_data = array();

    protected $_has_children = false;

    protected $_children = null;

    protected $_name = '';

    protected $_active = false;

    protected $_allowed = false;

    protected $_show = true;

    /**
     * @var Navigation_Element
     */
    protected $_parent = null;

    public function set($property, $value) {
        $this->_data[$property] = $value;
    }

    public function get($property) {
        if($property_name = '_' . $property AND property_exists($this, $property_name)) {
            return $this->{$property_name};
        }
        return $this->_data[$property];
    }

    public function __get($property) {
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

    public function setAllowed($allowed, $with_parent = true)
    {
        $this->_allowed = (bool)$allowed;
        if($with_parent == true && $this->hasParent() && $this->_allowed == true) {
            $this->getParent()->setAllowed($this->_allowed);
        }
    }

    public function setActive($active, $with_parent = true) {
        $this->_active = (bool)$active;
        if($with_parent == true && $this->hasParent()) {
            $this->getParent()->setActive($this->_active);
        }
    }

    public function setShow($show, $with_parent = true) {
        $this->_show = (bool)$show;
        if($with_parent == true && $this->hasParent() && $this->_show == true) {
            $this->getParent()->setActive($this->_show);
        }
    }

    public function setParent(Navigation_Element $parent) {
        $this->_parent = $parent;
    }

    public function hasParent() {
        return ($this->_parent instanceof Navigation_Element);
    }

    public function getParent() {
        return $this->_parent;
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

    public function __construct($_data, $name = null, $_parent = null) {
        $this->_data = $_data;
        $this->_name = $name;
        if($_parent != null) {
            $this->setParent($_parent);
        }
        $this->init();
    }

    public function init() {
        $this->_chck_is_active();
        $this->_chck_of_children();
        $this->_chck_allowed();
        $this->_chck_show();
    }

    protected function _chck_show() {
        if(isset($this->_data['show'])) {
            $this->setShow($this->_data['show']);
        }
    }

    protected function _chck_of_children()
    {
        $this->_has_children = (isset($this->_data['links']));
        if ($this->_has_children == true) {
            $this->_children = $this->_data['links'];
        }
    }

    protected function _chck_is_active() {
        $current_uri = Uri::current();
        if($current_uri == $this->get('route')) {
            $this->setActive(true);
        }
    }

    protected function _chck_allowed() {
        if($this->__isset('acl')) {
            $allowed = Auth::has_access($this->get('acl'));
            $this->setAllowed($allowed);
        }
    }

    public function hasChildren() {
        $this->_has_children = (isset($this->_data['links']));
        return $this->_has_children;
    }

    public function getChildren() {
        return $this->_data['links'];
    }


    public function addChildren($name, array $data) {
        if(!isset($this->_data['links'])) {
            $_tmp_data = array($name => $data);
            $this->_data['links'] = new Navigation_Elements($_tmp_data, $this);

        } else {
            $this->_data['links']->addElement($name, $data);
        }
        $this->init();
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