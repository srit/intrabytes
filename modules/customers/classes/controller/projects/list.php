<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Projects_List extends \Core\Controller_Base_User {

    public function action_index() {
        $customer_id = $this->params('customer_id');
        $this->projects = Model_Customer_Project::find_all_by_customer_id($customer_id);
        Theme::instance($this->template)->set_partial('content', 'customers/projects/list/index')->set('projects', $this->projects);
    }

}