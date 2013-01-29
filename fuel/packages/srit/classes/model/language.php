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
        'locale' => array(
            'validation' => array(
                'required',
                'min_length' => array(5)
            )
        ),
        'language' => array(
            'validation' => array(
                'required',
                'min_length' => array(2)
            )
        ),
        'plain' => array(
            'validation' => array(
                'required',
                'min_length' => array(3)
            )
        )
    );

    protected static $_has_many = array(
        'locales' => array(
            'cascade_save' => true,
            'cascade_delete' => true,
        ));
}