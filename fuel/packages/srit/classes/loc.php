<?php
/**
 * @created 30.01.13 - 13:55
 * @author stefanriedel
 */

namespace Srit;
class Loc
{

    /**
     * @var Loc
     */
    protected static $_instance = null;

    protected $_locale_prefix = null;

    protected $_locale = null;
    protected $_language = null;
    protected $_language_object = null;
    protected $_encoding = null;

    /**
     * @return \Srit\Model_Language
     */
    public function get_language_object()
    {
        return $this->_language_object;
    }

    public function set_language_object($language_object)
    {
        $this->_language_object = $language_object;
    }

    public function setEncoding($encoding)
    {
        //$encoding = (empty($encoding)) ? \Config::get('encoding') : $encoding;
        $this->_encoding = $encoding;
    }

    public function getEncoding()
    {
        return $this->_encoding;
    }

    public function setLanguage($language)
    {
        $this->_language = $language;
    }

    public function getLanguage()
    {
        return $this->_language;
    }

    public function setLocale($locale)
    {
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
        if (static::$_instance == null) {
            static::$_instance = new static();
        }
        return static::$_instance;
    }

    public function init_language() {
        $language_object = null;
        if (\Auth::check() && ($language_id = \Auth::get_user()->get_user_profile()->get_language_id()) != 0) {
            \Logger::forge()->addDebug('Language from Auth', array());
            $language_object = \Model_Language::find($language_id);
        } else {

            $languages = \Model_Language::find_all()->get_languages_array();
            $agent_languages = \Agent::languages();
            foreach ($agent_languages as $lang) {
                if (in_array($lang, $languages)) {
                    \Logger::forge()->addDebug('Language from Agent', array());
                    $language_object = \Model_Language::find_by_language_key($lang);
                    break;
                }
            }

            if ($language_object == null) {
                \Logger::forge()->addDebug('Default Language', array());
                $language_object = \Model_Language::find_default();
            }
        }

        $language = $language_object->get_language();
        $locale = $language_object->get_locale();
        $encoding = $language_object->get_encoding();
        $this->set_language_object($language_object);
        $this->setEncoding($encoding);
        $this->setLanguage($language);
        $this->setLocale($locale);

    }

    public function __construct()
    {
        $this->setLocalePrefix();
        $this->init_language();
    }

}