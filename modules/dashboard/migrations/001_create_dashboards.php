<?php
/**
 * @created 08.11.12 - 14:01
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Create_dashboards
{
    public function up()
    {
        \DBUtil::create_table('dashboard_items', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'name' => array('constraint' => 50, 'type' => 'varchar'),
            'route' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
        ), array('id'));

        \DBUtil::create_table('dashboard_items_users', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'dashboard_item_id' => array('constraint' => 11, 'type' => 'int'),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'order' => array('constraint' => 5, 'type' => 'int')

        ), array('id', 'dashboard_item_id', 'user_id'));
    }

    public function down()
    {
        \DBUtil::drop_table('dashboard_items');
        \DBUtil::drop_table('dashboard_items_users');
    }
}