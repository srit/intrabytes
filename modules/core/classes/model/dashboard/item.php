<?php
/**
 * @created 02.11.12 - 22:23
 * @author stefanriedel
 */

namespace Core;


class Model_Dashboard_Item extends \CachedModel {

    protected static $_has_many = array(
        'dashboard_items_user' => array(
            'model_to' => '\Model_Dashboard_Items_User',
            'cascade_save' => true,
            'cascade_delete' => true,
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

    public static function find_my() {
        return static::find_by_user(\Auth::instance()->get_user_id());
    }

    public static function find_by_user($id)
    {

        if(empty($id)) {
            throw new \Exception(__('exception.tasks.task.find_by_user.id.empty'));
        }

        $options = array(
            'where' => array(
                'dashboard_items_user.user_id' => (int)$id
            ),
        );

        return static::find_all($options);
    }

    public static function find($id = null, array $options = array()) {
        $tmp_options = array(
            'related' => array(
                'dashboard_items_user'
            ),
            'order_by' => array('dashboard_items_user.order' => 'ASC')
        );
        $options = array_merge_recursive($tmp_options, $options);
        return parent::find($id, $options);
    }

}