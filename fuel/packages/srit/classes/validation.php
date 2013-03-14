<?php
/**
 * @created 24.02.13 - 15:01
 * @author stefanriedel
 */

namespace Srit;

class Validation extends \Fuel\Core\Validation {

    public static function _validation_is_url($val) {
        $pattern = "#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie";
        return (preg_match($pattern, $val) != 0);
    }

}