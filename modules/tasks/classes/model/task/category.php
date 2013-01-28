<?php
/**
 * @created 16.11.12 - 12:32
 * @author stefanriedel
 */

namespace Tasks;
use \Srit\Model;

class Model_Task_Category extends Model {

    protected static $_properties = array(
        'id',
        'name',
        'color',
        'background_color',
        'client_id',
        'updated_at',
        'created_at'
    );

    protected static $_has_many = array(
        'task'
    );

    protected static $_belongs_to = array(
        'client' => array(
            'model_to' => 'Users\Model_Client'
        )
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