<?php
/**
 * @created 23.11.12 - 12:56
 * @author stefanriedel
 */

foreach ($tasks as $i => $task) {
    echo $theme->view($theme->get_templates_path_prefix() . 'dashboard/_partials/task_row', array('i' => $i, 'task' => $task), false);
}
