<?php
/**
 * @created 01.10.12 - 16:02
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Addnewpasswordhash
{
    public function up()
    {
        \DBUtil::add_fields(
            'users',
            array(
                'new_password_hash' => array('constraint' => 255, 'type' => 'varchar'),
            )
        );
    }

    public function down()
    {
        \DBUtil::drop_fields('users', array('new_password_hash'));
    }
}