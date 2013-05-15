<?php
/**
 * @created 16.11.12 - 09:52
 * @author stefanriedel
 */

namespace Tasks;

use Srit\Controller_BaseRawTemplate;

class Controller_Dashboard extends Controller_BaseRawTemplate {

    public function action_list() {
        $tasks = Model_Task::find_my();
        $this->_get_content_partial()->set('tasks', $tasks, false);
    }

}