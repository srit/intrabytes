<?php
/**
 * @created 19.10.12 - 11:17
 * @author stefanriedel
 */

Autoloader::add_core_namespace('Core');

Autoloader::add_classes(array(

    'Core\\Password' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'password.php',

    'Core\\Messages' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'messages.php',

    'Core\\Controller_Base_User' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'controller' . DS . 'base' . DS . 'user.php',
    'Core\\Controller_Base_Template' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'controller' . DS . 'base' . DS . 'template.php',
    'Core\\Controller_Base_Template_Public' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'controller' . DS . 'base' . DS . 'template' . DS . 'public.php',
    'Core\\Controller_Base_Template_Blank' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'controller' . DS . 'base' . DS . 'template' . DS . 'blank.php',
    'Core\\Controller_Base_Template_Blank_Public' => APPPATH . '..' . DS . '..' . DS . 'modules' . DS . 'core' . DS . 'classes' . DS . 'controller' . DS . 'base' . DS . 'template' . DS . 'blank' . DS . 'public.php',
));