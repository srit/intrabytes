<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */

require_once 'base.php';

Autoloader::add_core_namespace('Srit');
Autoloader::add_classes(array(
    'Srit\\Model' => __DIR__ . '/classes/model.php',
    'Srit\\Model_Language' => __DIR__ . '/classes/model/language.php',
    'Srit\\Model_Locale' => __DIR__ . '/classes/model/locale.php',
    'Srit\\Lang' => __DIR__ . '/classes/lang.php',
    'Srit\\Helper' => __DIR__ . '/classes/helper.php',
    'Srit\\Validation_Error' => __DIR__ . '/classes/validation/error.php'
));

\Srit\Lang::load_all();