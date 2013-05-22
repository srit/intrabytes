<?php
/**
 * @created 16.11.12 - 09:39
 * @author stefanriedel
 */
namespace Tasks;

use Auth\Auth;
use Srit\Exception;
use Srit\CachedModel;

class Model_Task extends CachedModel
{


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
        'Srit\\Observer_Localized' => array(
            'properties' => array(
                'due_date' =>array(
                    'type' => 'datetime'
                )
            )
        )
    );

    public static function find($id = null, array $options = array()) {
        $tmp_options = array(
            'related' => array(
                'task_category'
            ),
            'order_by' => array('id' => 'DESC')
        );
        $options = array_merge_recursive($tmp_options, $options);
        return parent::find($id, $options);
    }

    public static function find_my() {
        return static::find_by_user(Auth::instance()->get_user_id());
    }

    public static function find_by_user($id)
    {

        if(empty($id)) {
            throw new Exception(__('exception.tasks.task.find_by_user.id.empty'));
        }

        $options = array(
            'where' => array(
                'user_id' => (int)$id
            ),
        );

        return static::find_all($options);

    }

}