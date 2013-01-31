<?php
/**
 * @created 31.01.13 - 15:24
 * @author stefanriedel
 */
namespace Fuel\Migrations;

class Adddefaulttolanguages {

    public function up() {
        \Fuel\Core\DBUtil::add_fields('languages', array('default' => array('type' => 'bool')));
    }

    public function down() {
        \Fuel\Core\DBUtil::drop_fields('languages', array('default'));
    }

}