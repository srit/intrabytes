<?php
/**
 * @created 30.01.13 - 13:55
 * @author stefanriedel
 */

namespace Srit;

class Locale
{

    /**
     * @var Locale
     */
    protected static $_instance = null;

    protected $_locale_prefix = null;

    public function setLocalePrefix($locale_prefix = null)
    {
        if (null == $locale_prefix) {
            $request = \Fuel\Core\Request::forge();
            $module = $request->module;
            $controller = $request->controller;
            $action = $request->action;
            $controller = strtolower(substr($controller, strlen($module . '/Controller_')));
            $this->_locale_prefix = $module . '.' . $controller . '.' . $action;
        } else {
            $this->_locale_prefix = $locale_prefix;
        }
        return $this;
    }

    public function getLocalePrefix()
    {
        return $this->_locale_prefix;
    }

    public static function instance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->setLocalePrefix();
    }

}