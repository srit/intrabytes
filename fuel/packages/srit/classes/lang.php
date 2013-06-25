<?php
/**
 * @created 26.01.13 - 12:01
 * @author stefanriedel
 */

namespace Srit;

class Lang extends \Fuel\Core\Lang {

    protected static $_language = null;

    protected static $_locale = null;

    public static function get($line, array $params = array(), $default = null, $language = null)
    {
        if ($language === null)
        {
            $language = static::$_language;
        }
        $value = parent::get($line, $params, $default, $language);
        return $value ?: $default;
    }

    public static function init($language = null, $locale = null) {

        /**
         * static::$lines[$language][$group]
         */

        if(empty($language)) {
            $language = \Config::get('language');
        }

        if(empty($locale)) {
            $locale = \Config::get('locale');
        }

        static::$_language = $language;
        static::$_locale = $locale;

        $items = \Model_Locale::find_all_by_locale($locale);

        if($items != false) {
            foreach($items as $locale) {
                static::set($locale->key, $locale->value, $locale->group, $language);
                //static::$lines[$language][$locale->group.'.'.$locale->key] = $locale->value;
            }
        }

        //\Zend_Locale::setDefault(Locale::instance()->getLocale());

    }

}