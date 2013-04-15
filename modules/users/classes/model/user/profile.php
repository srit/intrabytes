<?php
/**
 * @created 02.11.12 - 12:13
 * @author stefanriedel
 */

namespace Users;

use Srit\Model;

class Model_User_Profile extends Model
{
    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
        'Srit\\Observer_Localized' => array(
            'properties' => array(
                'birthday' =>array(
                    'type' => 'date'
                )
            )
        )
    );

    protected static $_belongs_to = array(
        'user'
    );
}
