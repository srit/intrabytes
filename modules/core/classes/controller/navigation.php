<?php
/**
 * @created 22.04.13 - 12:20
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_Base_Template;
use Srit\Model_Navigation;

class Controller_Navigation extends Controller_Base_Template {

    public function action_index() {
        $this->_get_content_template()->set('trees', Model_Navigation::find_trees());

    }

}