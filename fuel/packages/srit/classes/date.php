<?php
/**
 * @created 15.04.13 - 12:35
 * @author stefanriedel
 */

namespace Srit;

class Date extends \Fuel\Core\Date
{

    public static function create_from_string($input, $pattern_key = 'local')
    {
        \Config::load('date', 'date');

        $pattern = \Config::get('date.patterns.' . $pattern_key, null);
        empty($pattern) and $pattern = $pattern_key;

        $timestamp = strtotime($input);
        if ($timestamp == false) {
            $time = strptime($input, $pattern);
            if ($time === false) {
                throw new \UnexpectedValueException('Input was not recognized by pattern.');
            }

            $timestamp = mktime($time['tm_hour'], $time['tm_min'], $time['tm_sec'],
                $time['tm_mon'] + 1, $time['tm_mday'], $time['tm_year'] + 1900);
            if ($timestamp === false) {
                throw new \OutOfBoundsException('Input was invalid.' . (PHP_INT_SIZE == 4 ? ' A 32-bit system only supports dates between 1901 and 2038.' : ''));
            }

        }

        return static::forge($timestamp);
    }

}