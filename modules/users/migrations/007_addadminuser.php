<?php
/**
 * @created 28.09.12 - 10:24
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Addadminuser
{
    public function up()
    {
        \Auth\Auth::create_user('admin', 'admin', 'admin@example.com', 100);
    }

    public function down()
    {
       \Auth\Auth::delete_user('admin');
    }
}