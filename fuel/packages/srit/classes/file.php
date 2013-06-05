<?php
/**
 * @created 27.05.13 - 14:40
 * @author stefanriedel
 */

namespace Srit;

class File extends \Fuel\Core\File
{

    protected static $_php_code_cache = array();

    protected static $_php_token_cache = array();

    public static function get_content($path)
    {
        $md5_path = md5($path);
        if (!isset(static::$_php_code_cache[$md5_path])) {
            static::$_php_code_cache[$md5_path] = file_get_contents($path);
        }
        return static::$_php_code_cache[$md5_path];
    }

    /**
     * @param $php_code
     * @return array
     */
    public static function get_token($php_code)
    {
        $md5_php_code = md5($php_code);
        if (!isset(static::$_php_token_cache[$md5_php_code])) {
            static::$_php_token_cache[$md5_php_code] = token_get_all($php_code);
        }
        return static::$_php_token_cache[$md5_php_code];
    }

    public static function get_token_and_count($php_code)
    {
        $token = static::get_token($php_code);
        $cnt = count($token);
        return array($token, $cnt);
    }

    public static function get_php_namespace_classes_extends($php_code)
    {
        $namespace = '';
        $classes = array();
        $last_class_name = null;
        list($tokens, $count) = static::get_token_and_count($php_code);

        for ($i = 2; $i < $count; $i++) {

            $token_identifier = $tokens[$i - 2][0];
            $token_value = isset($tokens[$i][1]) ? $tokens[$i][1] : '';


            if (($tokens[$i - 1][0] == T_WHITESPACE
                    && $tokens[$i][0] == T_STRING) ||
                (isset($tokens[$i + 1])
                    && $tokens[$i + 1][0] == T_STRING
                    && isset($tokens[$i - 1])
                    && $tokens[$i - 1][0] == T_WHITESPACE)
            ) {

                switch ($token_identifier) {
                    case T_NAMESPACE:
                        $namespace = $token_value;
                        break;
                    case T_CLASS:
                        $classes[$token_value] = null;
                        $last_class_name = $token_value;
                        break;
                    case T_EXTENDS:
                        if (isset($tokens[$i + 1])
                            && $tokens[$i + 1][0] == T_STRING
                            && isset($tokens[$i - 1])
                            && $tokens[$i - 1][0] == T_WHITESPACE
                        ) {
                            $token_value = $tokens[$i][1] . $tokens[$i + 1][1];
                        }
                        $classes[$last_class_name] = $token_value;
                        break;
                }

            }
        }
        return array($namespace, $classes);
    }

    public static function get_php_classes($php_code)
    {
        $classes = array();
        list($tokens, $count) = static::get_token_and_count($php_code);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING
            ) {

                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }
        return $classes;
    }

    public static function get_php_namespace($php_code)
    {
        $namespace = '';
        list($tokens, $count) = static::get_token_and_count($php_code);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_NAMESPACE
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING
            ) {
                $namespace = $tokens[$i][1];
                break;
            }
        }
        return $namespace;

    }

    public static function get_php_classes_extends($php_code)
    {
        $classes_extends = array();
        list($tokens, $count) = static::get_token_and_count($php_code);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_EXTENDS
                && $tokens[$i - 1][0] == T_WHITESPACE
                && $tokens[$i][0] == T_STRING
            ) {

                $class_name = $tokens[$i - 4][1];
                $extended_class = $tokens[$i][1];
                $classes_extends[$class_name] = $extended_class;
            }
        }
        return $classes_extends;
    }

    public static function get_php_namespace_from_file($path)
    {
        $php_code = static::get_content($path);
        return static::get_php_namespace($php_code);
    }

    public static function get_namespace_classes_extends_from_file($path)
    {
        $php_code = static::get_content($path);
        return static::get_php_namespace_classes_extends($php_code);
    }

    public static function get_php_classes_from_file($path)
    {
        $php_code = static::get_content($path);
        return static::get_php_classes($php_code);
    }

    public static function get_classes_extends_from_file($path)
    {
        $php_code = static::get_content($path);
        return static::get_php_classes_extends($php_code);
    }

    public static function find_classes_for_autoloader($files)
    {
        $classes = array();
        if (is_array($files)) {
            foreach ($files as $d => $f) {
                if (is_array($f)) {
                    $classes = array_merge($classes, static::find_classes_for_autoloader($f));
                } else {
                    $file_classes = static::get_namespace_classes_extends_from_file($f);
                    $classes = array_merge($classes, array($file_classes[0] . '\\' . key($file_classes[1]) => $f));
                }
            }
        }
        return $classes;
    }


}