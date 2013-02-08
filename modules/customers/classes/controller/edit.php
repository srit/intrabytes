<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Edit extends \Core\Controller_Base_User {

    public function action_index() {
        $this->id = (int)$this->param('id');
        $this->customer = Model_Customer::find($this->id);
        Theme::instance($this->template)->set_partial('content', 'customers/add/index')->set('customer', $this->customer);
    }

}