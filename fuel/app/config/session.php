<?php
/**
 * @created 02.05.13 - 15:00
 * @author stefanriedel
 */

return array(
    'driver'			=> 'file',
    'file' => array(
        'cookie_name' => 'iccrm', // name of the session cookie for file based sessions
        'path' => APPPATH . '..' . DS . '..' . DS . 'tmp', // path where the session files should be stored
        'gc_probability' => 5 // probability % (between 0 and 100) for garbage collection
    ),
);