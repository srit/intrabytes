<?php
/**
 * @created 24.11.12 - 13:04
 * @author stefanriedel
 */


namespace Fuel\Migrations;

class Createdbmenu
{
    public function up()
    {

        \DBUtil::create_table('dbmenu', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'catid' => array('constraint' => 11, 'type' => 'int'),
            'title' => array('constraint' => 50, 'type' => 'varchar'),
            'link' => array('type' => 'text'),
            'parent' => array('constraint' => 11, 'type' => 'int'),
            'position' => array('constraint' => 11, 'type' => 'int'),
            'parent' => array('constraint' => 11, 'type' => 'int'),
            'active' => array('type' => 'bool'),
            'divider' => array('type' => 'bool'),
            'menuicon' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),

        ), array('id'));

        \DBUtil::create_table('dbmenu_categories', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'catname' => array('constraint' => 255, 'type' => 'varchar'),
            'alias' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),

        ), array('id'));

        \Fuel\Core\DBUtil::create_index('dbmenu_categories', 'alias', 'alias', 'unique');

    }

    public function down()
    {
        \Fuel\Core\DBUtil::drop_table('dbmenu');
        \Fuel\Core\DBUtil::drop_table('dbmenu_categories');
    }
}