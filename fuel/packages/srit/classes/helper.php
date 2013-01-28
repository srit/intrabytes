<?php
/**
 * @created 19.01.13 - 18:54
 * @author stefanriedel
 */

namespace Srit;

class Helper {
    public static function getMonthArray($current = null) {

        $months = array();
        for ($m = 1; $m <= 12; ++$m) {
            $months[] = array('month' => ($m >= 10) ? $m : '0' . $m, 'current' => (null == $current || $m != $current) ? false : true );
        }

        return $months;

    }

    public static function getYearArray($current = null, $before = 5, $after = 5) {

        $year = (int)date('Y');
        $years = array();
        for ($y = $year - $before; $y <= $year + $after; ++$y) {
            $years[] = array('year' => $y, 'current' => (null == $current || $y != $current) ? false : true );
        }

        return $years;

    }
}