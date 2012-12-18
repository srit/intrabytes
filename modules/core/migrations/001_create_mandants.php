<?php

namespace Fuel\Migrations;

class Create_mandants
{
	public function up()
	{
		\DBUtil::create_table('mandants', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 50, 'type' => 'varchar'),
			'description' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('mandants');
	}
}