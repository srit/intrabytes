<?php
/**
 * @created 05.02.13 - 13:00
 * @author stefanriedel
 */

namespace Projects;

use \Core\Messages;
use \Core\Theme;

class Controller_Add extends \Core\Controller_Base_User {

    public function action_index() {
        $this->project = Model_Project::forge();
        Theme::instance($this->template)->set_partial('content', 'customer/add/index')->set('project', $this->project);
    }

}