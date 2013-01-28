<?php
/**
 * @created 25.01.13 - 16:00
 * @author stefanriedel
 */

namespace Fuel\Migrations;

class Createlocalesandlanguages
{
    public static function up()
    {
        \DBUtil::create_table('locales', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'key' => array('constraint' => 255, 'type' => 'varchar'),
            'group' => array('constraint' => 255, 'type' => 'varchar'),
            'value' => array('type' => 'text'),
            'language_id' => array('constraint' => 11, 'type' => 'int'),
        ), array('id', 'language_id'));

        \DBUtil::create_table('languages', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
            'locale' => array('constraint' => 10, 'type' => 'varchar'),
            'language' => array('constraint' => 2, 'type' => 'varchar'),
            'plain' => array('constraint' => 200, 'type' => 'varchar'),
        ), array('id'));

        \DBUtil::create_index('locales', 'key', 'key');
        \DBUtil::create_index('locales', 'group', 'group');

        /**
         *
         */
    }

    public static function down()
    {
        \DBUtil::drop_table('locales');
        \DBUtil::drop_table('languages');
    }
}