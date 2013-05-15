<?php
/**
 * @created 22.04.13 - 12:20
 * @author stefanriedel
 */

namespace Core;

use Srit\Controller_Base_Template;
use Srit\Controller_BaseBigTemplate;
use Srit\Model_Navigation;

class Controller_Navigation extends Controller_BaseBigTemplate {

    public function action_index() {
        $this->_get_content_partial()->set('trees', Model_Navigation::find_trees());

    }

}