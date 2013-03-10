<?php

namespace Core;


use Srit\Model;

class Model_Mandant extends Model
{
    protected static $_properties = array(
        'id',
        'name',
        'description',
        'created_at',
        'updated_at'
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => true,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => true,
        ),
    );



}
