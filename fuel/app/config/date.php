<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2012 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * NOTICE:
 *
 * If you need to make modifications to the default configuration, copy
 * this file to your app/config folder, and make them in there.
 *
 * This will allow you to upgrade fuel without losing your custom config.
 */


return array(

	/**
	 * A couple of named patterns that are often used
	 */
	'patterns' => array(
		'de'		 => '%d.%m.%Y',
		'de_short'	 => '%d.%m',
        'de_normal'  => '%d.%m.%Y %H:%M',
		'de_full'	 => '%d.%B %Y %H:%M:%S',
	)
);