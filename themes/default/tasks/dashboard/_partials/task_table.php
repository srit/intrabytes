<?php
/**
 * @created 23.11.12 - 12:56
 * @author stefanriedel
 */

foreach ($tasks as $i => $task) {
    echo $theme->view('tasks/dashboard/_partials/task_row', array('i' => $i, 'task' => $task));
}
