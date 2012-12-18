<?php
/**
 * @created 08.11.12 - 14:01
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Additemsorder
{
    public function up()
    {


        \DBUtil::add_fields(
            'dashboard_items_users',
            array(
                'order' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
            )
        );
    }

    public function down()
    {
        \DBUtil::drop_fields('dashboard_items_users', array('order'));
    }
}