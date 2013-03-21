<?php
/**
 * @created 21.03.13 - 14:21
 * @author stefanriedel
 */

namespace Srit;

class Navigation_Element {

    protected $_data = array();

    protected $_has_childs = false;

    protected $_childs = null;

    public function __get($property) {
        if($property == 'links' || !isset($this->_data[$property])) {
            return null;
        }
        return $this->_data[$property];
    }

    public function __construct($_data) {
        $this->_data = $_data;
        $this->init();
    }

    public function init() {
        if($this->hasChilds()) {
            $this->setChilds(new Navigation_Elements($this->_data['links']));
        }
    }

    public function hasChilds() {
        $this->_has_childs = (isset($this->_data['links']) && is_array($this->_data['links']));
        return $this->_has_childs;
    }

    public function setChilds(Navigation_Elements $childs) {
        $this->_childs = $childs;
    }

    public function getChilds() {
        return $this->_childs;
    }
}