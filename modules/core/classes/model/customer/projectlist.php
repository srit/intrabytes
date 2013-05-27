<?php
/**
 * @created 22.05.13 - 14:58
 * @author stefanriedel
 */

namespace Core;

use Srit\ModelList;

class Model_Customer_ProjectList extends ModelList {
    public function __toString() {
        $ret = '';
        if(!empty($this->_elements)) {
            $copy_data = $this->_elements;
            $obj = array_shift($copy_data);
            $ret = (string)$obj->get_customer();
        }
        return $ret;
    }
}