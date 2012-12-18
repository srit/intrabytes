<?php
/**
 * @created 28.09.12 - 10:24
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Createprofiletable
{
    public function up()
    {
        \DBUtil::create_table('profiles', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'firstname' => array('constraint' => 50, 'type' => 'varchar'),
            'lastname' => array('constraint' => 50, 'type' => 'varchar'),
            'birthday' => array('type' => 'date', 'null' => true),
            'gender' => array('constraint' => 1, 'type' => 'varchar', 'null' => true),
            'created_at' => array('type' => 'datetime'),
            'updated_at' => array('type' => 'datetime'),

        ), array('id', 'user_id'));
    }

    public function down()
    {
        \DBUtil::drop_table('profiles');
    }
}