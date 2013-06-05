<?php
/**
 * @created 16.11.12 - 09:52
 * @author stefanriedel
 */

namespace Tasks;

class Controller_Dashboard extends \Controller_BaseRawTemplate {

    public function action_list() {
        $tasks = \Model_Task::find_my();
        $this->_get_content_partial()->set('tasks', $tasks, false);
    }

    public function action_add() {
        $task = \Model_Task::forge();
        if(\Input::post('add', false)) {

        }
        $this->_get_content_partial()->set('task', $task, false);
    }

}