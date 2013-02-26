<?php
/**
 * @created 05.02.2013 - 11:10
 * @author stefanriedel
 */

namespace Customers;

use \Core\Messages;
use \Core\Theme;

class Controller_Projects_Add extends Controller_Projects {
    
    public function action_index() {
        $this->redmines = \Redmines\Model_Redmine::find_all_for_html_select();
        $this->_get_content_template()
            ->set('redmines', $this->redmines);
    }

}