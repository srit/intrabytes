<?php
/**
 * @created 16.11.12 - 09:52
 * @author stefanriedel
 */

namespace Tasks;

use Core\Theme;

class Controller_Dashboard extends \Core\Controller_Base_User_Raw {

    public function action_list() {
        $tasks = Model_Task::find_by_user($this->_user->id);
        Theme::instance()->set_partial('content', 'tasks/dashboard/list')->set('tasks', $tasks, false);
    }

}