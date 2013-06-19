<?php
/**
 * @created 02.11.12 - 12:13
 * @author stefanriedel
 */

namespace Srit;

use Auth\Auth;
use Srit\Model;

class Model_User_Profile extends \CachedModel
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
        '\Observer_Localized' => array(
            'properties' => array(
                'birthday' =>array(
                    'type' => 'date'
                )
            )
        )
    );

    protected static $_belongs_to = array(
        'user' => array(
            'model_to' => '\Model_User'
        )
    );

    public static function find_my() {
        return static::find('first', array('where' => array(
            'user_id' =>  \Auth::get_user()->id
        )));
    }
}
