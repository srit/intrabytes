<?php
/**
 * @created 16.11.12 - 11:00
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Createtasktable {

    public static function up() {
        \Fuel\Core\DBUtil::create_table('tasks', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'due_date' => array('type' => 'datetime'),
            'task_category_id' => array('constraint' => 11, 'type' => 'int'),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'global' => array('type' => 'bool'),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
        ), array('id', 'task_category_id'));

        \Fuel\Core\DBUtil::create_table('task_categories', array(
            'id' =>  array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'name' => array('constraint' => 50, 'type' => 'varchar'),
            'color' => array('constraint' => 7, 'type' => 'varchar', 'default' => '#333333'),
            'client_id' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),
        ), array('id', 'client_id'));

    }

    public static function down() {
        \Fuel\Core\DBUtil::drop_table('tasks', 'task_categories');
    }

}