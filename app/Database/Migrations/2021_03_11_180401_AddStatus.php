<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatus extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 7,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'status' => [
				'type' => 'VARCHAR',
				'constraint' => 30,
			],
			'id_user' => [
				'type' => 'INT',
				'constraint' => 7,
				'unsigned' => true,
			]
		]);

		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('id_user','user','id','CASCADE','NO ACTION');
		$this->forge->createTable('status');
	}

	public function down()
	{
		$this->forge->dropTable('status');
	}
}
