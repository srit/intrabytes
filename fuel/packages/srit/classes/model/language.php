<?php
/**
 * @created 25.01.13 - 14:24
 * @author stefanriedel
 */

namespace Srit;
use \Srit\Model;

class Model_Language extends Model
{
    protected static $_properties = array(
        'id',
        'locale',
        'language',
        'plain'
    );

    protected static $_has_many = array(
        'locales' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        ));
}