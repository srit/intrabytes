<?php
/**
 * @created 01.10.12 - 16:02
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Addpasswordresetted
{
    public function up()
    {
        \DBUtil::add_fields(
            'users',
            array(
                'password_resetted' => array('type' => 'bool'),
                'password_resetted_at' => array('constraint' => 11, 'type' => 'int'),
            )
        );
    }

    public function down()
    {
        \DBUtil::drop_fields('users', array('password_resetted', 'password_resetted_at'));
    }
}