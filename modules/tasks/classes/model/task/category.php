<?php
/**
 * @created 16.11.12 - 12:32
 * @author stefanriedel
 */

namespace Tasks;

class Model_Task_Category extends \CachedModel
{

    protected static $_has_many = array(
        'task' => array(
            'model_to' => '\Model_Task'
        )
    );

    protected static $_belongs_to = array(
        'client' => array(
            'model_to' => '\Model_Client'
        )
    );

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

}