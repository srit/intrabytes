<?php
/**
 * @created 11.02.13 - 19:00
 * @author stefanriedel
 */
namespace Users;
use \Srit\Model;

class Model_User_Public_Key extends Model {
    protected static $_properties = array(
        'id',
        'user_id',
        'name',
        'value',
        'created_at' => array(
            'type' => 'datetime'
        ),
        'updated_at'
    );

    protected static $_belongs_to = array(
        'user',
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

    public static function find_for_edit($id, $user_id, array $options = array()) {
        $model_options = array(
            'where' => array(
                'id' => (int)$id,
                'user_id' => (int)$user_id
            )
        );
        $options = array_merge_recursive($options, $model_options);
        return static::find('first', $options);
    }

}
