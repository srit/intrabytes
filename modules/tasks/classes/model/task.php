<?php
/**
 * @created 16.11.12 - 09:39
 * @author stefanriedel
 */
namespace Tasks;
use \Core\Model;

class Model_Task extends Model
{

    protected static $_properties = array(
        'id',
        'title',
        'due_date',
        'task_category_id',
        'user_id',
        'global',
        'created_at',
        'updated_at'
    );

    protected static $_belongs_to = array(
        'task_category'
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

    public static function find_by_user($id)
    {
        $id = trim($id);
        $properties = static::$_properties;
        $p = array_combine($properties, $properties);
        $tasks = static::query()
            ->related('task_category')
            ->where_open()
            ->where('user_id', '=', $id)
            ->where_close()
            ->get();

        return $tasks ? : false;
    }

}