<?php
/**
 * @created 23.11.12 - 21:20
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Addbackgroundcolor
{
    public function up()
    {


        \DBUtil::add_fields(
            'task_categories',
            array(
                'background_color' => array('constraint' => 8, 'type' => 'varchar', 'after' => 'color'),
            )
        );
    }

    public function down()
    {
        \DBUtil::drop_fields('task_categories', array('background_color'));
    }
}