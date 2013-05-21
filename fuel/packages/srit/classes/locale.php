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

    protected $_locale = null;
    protected $_language = null;
    /**
     * @var Model_Language
     */
    protected $_language_model = null;
    protected $_encoding = null;

    /**
     * @param \Srit\Model_Language $language_model
     */
    public function loadLanguageModel($language)
    {
        $this->_language_model = Model_Language::find_by_language_key($language);
    }

    /**
     * @return \Srit\Model_Language
     */
    public function getLanguageModel()
    {
        return $this->_language_model;
    }

    public function setEncoding($encoding = null)
    {
        $encoding = (empty($encoding)) ? \Config::get('encoding') : $encoding;
        $this->_encoding = $encoding;
    }

    public function getEncoding()
    {
        return $this->_encoding;
    }

    public function setLanguage($language = null)
    {
        $language = (empty($language)) ? \Config::get('language') : $language;
        $this->_language = $language;
    }

    public function getLanguage()
    {
        return $this->_language;
    }

    public function setLocale($locale = null)
    {
        $locale = (empty($locale)) ? \Config::get('locale') : $locale;
        $this->_locale = $locale;
    }

    public function getLocale()
    {
        return $this->_locale;
    }

    public function setLocalePrefix($locale_prefix = null)
    {
        if (null == $locale_prefix) {
            $request = \Request::forge();
            $module = $request->module;
            $controller = $request->controller;
            $action = (!empty($request->action)) ? $request->action : 'index';
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
        $this->setLanguage();
        $this->setLocale();
        $this->setEncoding();
        $this->loadLanguageModel($this->_language);
    }

}