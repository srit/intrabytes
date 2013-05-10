<?php
/**
 * @created 16.11.12 - 09:52
 * @author stefanriedel
 */

namespace Tasks;

use Srit\Controller_Base_User_Raw;
use Srit\Theme;

class Controller_Dashboard extends Controller_Base_User_Raw {

    public function action_list() {
        $tasks = Model_Task::find_my();
        Theme::instance()->set_partial('content', 'tasks/dashboard/list')->set('tasks', $tasks, false);
    }

}