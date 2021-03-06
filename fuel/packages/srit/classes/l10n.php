<?php
/**
 * @created 03.02.13 - 20:20
 * @author stefanriedel
 */

namespace Srit;


class L10n
{

    const FORMAT_ISO_8601 = 1;

    /**
     * @var L10n
     */
    protected static $_instance = null;

    /**
     * @var Loc
     */
    protected $_locale = null;

    public static function instance($locale = null)
    {

        if (static::$_instance == null) {
            static::$_instance = new self($locale);
        }

        return static::$_instance;
    }

    public function __construct($locale = null)
    {

        $this->_locale = \Loc::instance();

        if (is_string($locale)) {
            $this->_locale->setLocale($locale);
        }


    }

    public function reformat_decimal($value)
    {
        $nf = new \NumberFormatter($this->_locale->getLocale(), \NumberFormatter::DECIMAL);
        return $nf->parse($value, \NumberFormatter::TYPE_DOUBLE);
    }

    public function reformat_date($value, $format = static::FORMAT_ISO_8601)
    {

        $timestamp = strtotime($value);
        return date('Y-m-d', $timestamp);

        /**$dateFormatter = \IntlDateFormatter::create(
        Locale::instance()->getLocale(),
        \IntlDateFormatter::MEDIUM,
        \IntlDateFormatter::NONE
        );
        return $dateFormatter->parse($value);**/
    }

    public function reformat_datetime($value, $format = static::FORMAT_ISO_8601)
    {
        $timestamp = strtotime($value);
        return date('Y-m-d H:i:s', $timestamp);

        /**$dateFormatter = \IntlDateFormatter::create(
        Locale::instance()->getLocale(),
        \IntlDateFormatter::MEDIUM,
        \IntlDateFormatter::NONE
        );
        return $dateFormatter->parse($value);**/
    }

    public function format_currency($value, $decimals = 2)
    {
        $nf = new \NumberFormatter($this->_locale->getLocale(), \NumberFormatter::CURRENCY);

        return $nf->formatCurrency($value, \Loc::instance()->getLanguageModel()->currency);
        //return $this->_format_numbers($value, $decimals, \NumberFormatter::CURRENCY);


    }

    public function format_date($value, $pattern = 'mysql_date')
    {

        if(is_int($value)) {
            $value = date('Y-m-d', $value);
        }

        return \Date::create_from_string($value, $pattern)->format($this->_locale->getLanguage());

        /**$time = strtotime($value);

        $dateFormatter = \IntlDateFormatter::create(
        Locale::instance()->getLocale(),
        \IntlDateFormatter::MEDIUM,
        \IntlDateFormatter::NONE
        );

        return $dateFormatter->format($time);**/
    }

    public function format_datetime($value, $pattern = 'mysql')
    {
        $language = $this->_locale->getLanguage();

        if(is_int($value)) {
            $value = date('Y-m-d H:i:s', $value);
        }

        return \Date::create_from_string($value, $pattern)->format($language . '_full');

        /**$time = strtotime($value);

        $dateFormatter = \IntlDateFormatter::create(
        Locale::instance()->getLocale(),
        \IntlDateFormatter::MEDIUM,
        \IntlDateFormatter::SHORT
        );

        return $dateFormatter->format($time);**/
    }

    public function format_decimal($value, $decimals = 2)
    {
        return $this->_format_numbers($value, $decimals, \NumberFormatter::DECIMAL);
    }

    protected function _format_numbers($value, $decimals, $style)
    {
        $nf = new \NumberFormatter($this->_locale->getLocale(), $style);
        $nf->setPattern(str_repeat('@', $decimals));
        return $nf->format($value);
    }

}