<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_List extends \Core\Controller_Base_User {

    public function action_index() {

        Theme::instance($this->template)->set_partial('content', 'customers/list/index');
    }

}