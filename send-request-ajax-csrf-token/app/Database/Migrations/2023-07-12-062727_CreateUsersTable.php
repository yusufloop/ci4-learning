<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' =>true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'TEXT',
                'constraint' => '100',
            ],
            'username' => [
                'type' => 'TEXT',
                'constraint' => '100',
            ],
            'gender' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '80',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
