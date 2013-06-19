<?php
/**
 * @created 30.09.12 - 22:04
 * @author stefanriedel
 */

return array(
    'name' => 'IntraBytes',
    'max_last_pages' => 5,
    'locked_mode' => 1,
    'locked_exceptions' => array(
        'Core\\Login.index',
        'Core\\403.index',
        'Core\\404.index',
        'Core\\500.index',
        'Core\\Password.forget',
        'Core\\Password.confirmed_email'
    )
);