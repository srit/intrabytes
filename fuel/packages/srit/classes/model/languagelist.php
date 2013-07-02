<?php
/**
 * @created 01.07.13 - 09:31
 * @author stefanriedel
 *
 * public function get_module_names_array() {
foreach($this->_elements as $module) {
$this->_module_names_array[] = $module->get_name();
}
return $this->_module_names_array;
}
 *
 */

namespace Srit;

class Model_LanguageList extends \ModelList {

    protected $_languages_array = array();

    public function get_languages_array() {
        foreach($this->_elements as $language) {
            $this->_languages_array[] = $language->get_language();
        }
        return $this->_languages_array;
    }
}