<?php
/**
 * @created 26.05.13 - 21:30
 * @author stefanriedel
 */

return array(
    'title' => array(
        'de' => 'Tasks',
        'en' => 'tasks'
    ),
    'description' => array(
        'de' => 'Task Modul',
        'en' => 'task module'
    ),
    'author' => 'Stefan Riedel',
    'version' => '0.1',
    'extend' => array(
        'Srit\\Model_User' => 'tasks/classes/model/user.php'
    ),
);