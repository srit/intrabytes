<?php
/**
 * @created 02.11.12 - 22:23
 * @author stefanriedel
 */

namespace Dashboard;
use \Srit\Model;

class Model_Dashboard_Item extends Model {

    protected static $_has_many = array(
        'dashboard_items_user' => array(
            'model_to' => 'Dashboard\Model_Dashboard_Items_User',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
    );


    protected static $_properties = array(
        'id',
        'name',
        'route',
        'created_at',
        'updated_at',
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
        $items = static::query()
            ->related('dashboard_items_user', array('order_by' => array('order')))
            ->related('dashboard_items_user.user', array('where' => array('id' => $id)))
            ->get();

        return $items ? : false;
    }

}