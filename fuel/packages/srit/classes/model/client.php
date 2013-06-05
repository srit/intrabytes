<?php
/**
 * @created 02.11.12 - 09:13
 * @author stefanriedel
 */


namespace Srit;

class Model_Client extends \CachedModel
{
    protected static $_observers = array(
        '\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        '\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
    );

    protected static $_has_many = array(
        'users' => array(
            'model_to' => '\Moder_User',
            'cascade_save' => true,
            'cascade_delete' => true,
        ));

    /*public static function validate($factory)
    {
        $val = \Validation::forge($factory);
        $val->add_field('name', 'Name', 'required|max_length[50]');

        return $val;
    }*/

    public function __toString()
    {
        return $this->get_name();
    }

}