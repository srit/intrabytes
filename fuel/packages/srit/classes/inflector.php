<?php
/**
 * @created 14.02.2013
 * @author stefanriedel
 */

namespace Srit;

class Inflector extends \Fuel\Core\Inflector {

    /**
     * Takes a CamelCased string and returns an underscore separated version.
     *
     * @param   string  the CamelCased word
     * @return  string  an underscore separated version of $camel_cased_word
     */
    public static function underscore($camel_cased_word) {
        return preg_replace('/([A-Z]+)([A-Z])/', '\1_\2', preg_replace('/([a-z\d])([A-Z])/', '\1_\2', strval($camel_cased_word)));
    }

}
