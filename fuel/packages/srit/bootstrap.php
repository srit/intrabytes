<?php
/**
 * @created 27.01.13 - 16:27
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Srit');
Autoloader::add_classes(array(
    'Srit\\Model' => __DIR__ . '/classes/model.php',
    'Srit\\Model_Language' => __DIR__ . '/classes/model/language.php',
    'Srit\\Model_Locale' => __DIR__ . '/classes/model/locale.php',
    'Srit\\Model_Postalcode' => __DIR__ . '/classes/model/postalcode.php',
    'Srit\\Model_Country' => __DIR__ . '/classes/model/country.php',
    'Srit\\Lang' => __DIR__ . '/classes/lang.php',
    'Srit\\Helper' => __DIR__ . '/classes/helper.php',
    'Srit\\Locale' => __DIR__ . '/classes/locale.php',
    'Srit\\L10n' => __DIR__ . '/classes/l10n.php',
    'Srit\\Validation_Error' => __DIR__ . '/classes/validation/error.php',
));

require_once 'base.php';

\Srit\Lang::init();