<?php
/**
 * @created 28.09.12 - 10:24
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Createclienttable {
    public function up()
    {
        \DBUtil::create_table('clients', array(
                'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
                'name' => array('constraint' => 50, 'type' => 'varchar'),
                'created_at' => array('type' => 'datetime'),
                'updated_at' => array('type' => 'datetime'),

            ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('clients');
    }
}