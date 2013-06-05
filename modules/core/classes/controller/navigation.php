<?php
/**
 * @created 22.04.13 - 12:20
 * @author stefanriedel
 */

namespace Core;

class Controller_Navigation extends \Controller_BaseBigTemplate {

    public function action_index() {
        $this->_get_content_partial()->set('trees', \Model_Navigation::find_trees());

    }

}