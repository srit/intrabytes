<?php
/**
 * @created 12.06.13 - 10:32
 * @author stefanriedel
 */

namespace Srit;

class Model_ModuleList extends \ModelList {

    protected $_module_names_array = array();

    public function get_module_names_array() {
        foreach($this->_elements as $module) {
            $this->_module_names_array[] = $module->get_name();
        }
        return $this->_module_names_array;
    }
}