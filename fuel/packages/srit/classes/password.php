<?php
/**
 * @created 30.10.12 - 09:28
 * @author stefanriedel
 */
namespace Srit;

class Password {
    public static function password_hash($password, $algo, array $options = array()) {
        return password_hash($password, $algo, $options);
    }

    public static function password_get_info($hash) {
        return password_get_info($hash);
    }

    public static function password_needs_rehash($hash, $algo, array $options = array()) {
        return password_needs_rehash($hash, $algo, $options);
    }

    public static function password_verify($password, $hash) {
        return password_verify($password, $hash);
    }
}