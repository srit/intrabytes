<?php
/**
 * @created 28.01.13 - 17:20
 * @author stefanriedel
 */

namespace Srit;

class Validation_Error extends \Fuel\Core\Validation_Error {

    public static function _init()
    {
        return false;
    }

    /**
     * @param bool $msg
     * @param string $open
     * @param string $close
     * @return string
     */
    public function get_message($msg = false, $open = '', $close = '') {
        return __('validation.' . $this->field->name . '.' . $this->rule . '.error');
    }

}