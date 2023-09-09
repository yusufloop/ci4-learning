<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => true,
				'auto_increment' => true,
			],
			'sortname' => [
				'type' => 'VARCHAR',
				'constraint' => '10',
				'null' => false
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => false
			],
			'phoneCode' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => false
			]
		]);
		$this->forge->addPrimaryKey('id');
        $this->forge->createTable('countries');
    }

    public function down()
    {
        $this->forge->dropTable('countries');
    }
}
