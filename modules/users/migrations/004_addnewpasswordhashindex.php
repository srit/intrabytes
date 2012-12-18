<?php
/**
 * @created 01.10.12 - 16:02
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Addnewpasswordhashindex
{
    public function up()
    {
        \DBUtil::create_index('users', 'new_password_hash', 'new_password_hash');
    }

    public function down()
    {
        \DBUtil::drop_index('users', 'new_password_hash');
    }
}