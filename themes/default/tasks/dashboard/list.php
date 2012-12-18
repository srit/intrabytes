<?php
/**
 * @created 21.11.12 - 15:18
 * @author stefanriedel
 */

if(false !== $tasks) {
    echo $theme->view('tasks/dashboard/_partials/task_table', array('tasks' => $tasks));
}