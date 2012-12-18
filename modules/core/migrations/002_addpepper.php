<?php
/**
 * @created 01.10.12 - 16:02
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Addpepper
{
    public function up()
    {
        \DBUtil::add_fields(
            'users',
            array(
                'pepper' => array('constraint' => 32, 'type' => 'varchar'),
            )
        );
    }

    public function down()
    {
        \DBUtil::drop_fields('users', 'pepper');
    }
}