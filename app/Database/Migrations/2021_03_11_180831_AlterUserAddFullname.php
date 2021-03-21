<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUserAddFullname extends Migration
{
	public function up()
	{
		$field = [
			'fullname' => [
				'type' => 'TEXT',
				'null' => true,
			]
		];
		$this->forge->addColumn('user',$field);
	}

	public function down()
	{
		$this->forge->dropColumn('user', 'fullname');
	}
}
