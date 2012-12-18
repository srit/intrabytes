<?php
/**
 * @created 28.09.12 - 10:24
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Createtables {
    public function up()
    {
        \DBUtil::create_table('users', array(
                'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
                'client_id' => array('constraint' => 11, 'type' => 'int'),
                'username' => array('constraint' => 50, 'type' => 'varchar'),
                'password' => array('constraint' => 255, 'type' => 'varchar'),
                'group' => array('constraint' => 11, 'type' => 'int'),
                'email' => array('constraint' => 255, 'type' => 'varchar'),
                'last_login' => array('constraint' => 11, 'type' => 'int'),
                'login_hash' => array('constraint' => 255, 'type' => 'varchar'),
                'profile_fields' => array('type' => 'text'),
                'created_at' => array('type' => 'datetime'),
                'updated_at' => array('type' => 'datetime'),

            ), array('id', 'mandant_id'));
    }

    public function down()
    {
        \DBUtil::drop_table('users');
    }
}