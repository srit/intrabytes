<?php

namespace Core;
/**
 * @created 28.09.12 - 13:08
 * @author stefanriedel
 */
class Typo
{
    public static function h($size, $value, $attributes = array())
    {
        return '<h' . (int)$size . static::attributes($attributes) . '>' . $value . '</h' . (int)$size . '>';
    }

    public static function attributes(array $attributes = null)
    {
        if (empty($attributes)) {
            return '';
        }

        $sorted = array();
        foreach (HTML::$attribute_order as $key) {
            if (isset($attributes[$key])) {
                // Add the attribute to the sorted list
                $sorted[$key] = $attributes[$key];
            }
        }

        // Combine the sorted attributes
        $attributes = $sorted + $attributes;

        $compiled = '';
        foreach ($attributes as $key => $value) {
            if ($value === null) {
                // Skip attributes that have NULL values
                continue;
            }

            if (is_int($key)) {
                // Assume non-associative keys are mirrored attributes
                $key = $value;
            }

            // Add the attribute value
            $compiled .= ' ' . $key . '="' . static::chars($value) . '"';
        }

        return $compiled;
    }

    public static function chars($value, $double_encode = true)
    {
        $charset = \Config::get('config.encoding');
        return htmlspecialchars((string)$value, ENT_QUOTES, $charset, $double_encode);
    }
}
