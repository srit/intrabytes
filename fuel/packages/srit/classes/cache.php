<?php
/**
 * @created 03.06.13 - 13:49
 * @author stefanriedel
 */

namespace Srit;

class Cache extends \Fuel\Core\Cache
{
    public static function build_cache_identifier_from_array(array $params, $separator = '_', $rtrim = true)
    {
        $identifier = '';
        foreach ($params as $k => $v) {
            if (is_array($v)) {
                $identifier .= trim($k) . $separator;
                $identifier .= static::build_cache_identifier_from_array($v, $separator, $rtrim);
            } else {
                $identifier .= $k . '_' . $v . $separator;
            }
        }

        if ($rtrim == true) {
            $identifier = rtrim($identifier, $separator);
        }

        $patterns = array(
            '/[\\\ %@\/\+]/',
            '/[!]/',
            '/[=]/'
        );

        $placement = array(
            $separator,
            'not',
            'same'
        );

        $identifier = preg_replace($patterns, $placement, $identifier);

        return $identifier;
    }
}