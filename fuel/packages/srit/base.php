<?php
/**
 * @created 29.01.13 - 14:55
 * @author stefanriedel
 */

/**
 * Wrapper für @used \Fuel\Core\Security::xss_clean
 *
 * @param $value
 * @return array|mixed|string
 */
function xss_clean($value)
{
    return \Fuel\Core\Security::xss_clean($value);
}

function getMonthArray($current = null)
{

    $months = array();
    for ($m = 1; $m <= 12; ++$m) {
        $months[] = array('month' => ($m >= 10) ? $m : '0' . $m, 'current' => (null == $current || $m != $current) ? false : true);
    }

    return $months;

}

function getYearArray($current = null, $before = 5, $after = 5)
{

    $year = (int)date('Y');
    $years = array();
    for ($y = $year - $before; $y <= $year + $after; ++$y) {
        $years[] = array('year' => $y, 'current' => (null == $current || $y != $current) ? false : true);
    }

    return $years;

}