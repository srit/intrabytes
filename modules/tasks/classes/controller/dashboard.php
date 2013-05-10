<?php
/**
 * @created 16.11.12 - 09:52
 * @author stefanriedel
 */

namespace Tasks;

use Core\Theme;
use Srit\Controller_Base_User_Raw;

class Controller_Dashboard extends Controller_Base_User_Raw {

    public function action_list() {
        $tasks = Model_Task::find_by_user($this->_user->id);
        Theme::instance()->set_partial('content', 'tasks/dashboard/list')->set('tasks', $tasks, false);
    }

}