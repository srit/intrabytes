<?php
/**
 * @created 26.05.13 - 21:30
 * @author stefanriedel
 */

$version = '0.1';

$module = array(
    'title' => array(
        'de' => 'Core',
        'en' => 'core'
    ),
    'description' => array(
        'de' => 'Core Modul',
        'en' => 'core module'
    ),
    'author' => 'Stefan Riedel',
    'version' => '0.1',
    'extend' => array(
        'Srit\\Model_User' => 'core/classes/model/password.php'
    ),
);