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
    'prep_value' => true,
    'auto_id' => true,
    'auto_id_prefix' => 'form_',
    'form_method' => 'post',
    'form_template' => "\n\t\t{open}\n\t\t\n{fields}\n\t\t\n\t\t{close}\n",
    'fieldset_template' => "\n\t\t{open}\n{fields}\n\t\t{close}\n",
    'field_template' => "\t\t<div class=\"control-group\">\n\t\t\t<div class=\"control-label\">{label}{required}</div>\n\t\t\t<div class=\"controls\">{field} {description} {error_msg}</div></div>\n\t\t\n",
    'multi_field_template' => "\t\t<div class=\"control-group\">\n\t\t\t<div class=\"control-label\">{group_label}{required}</div>\n\t\t\t<div class=\"{error_class}\">{fields}\n\t\t\t\t{field} {label}<br />\n<div class=\"controls\">{fields}</div>{description}\t\t\t{error_msg}\n\t\t\t\n\t\t\n",
    'error_template' => '<span>{error_msg}</span>',
    'required_mark' => '',
    'inline_errors' => false,
    'error_class' => 'validation_error',
);
