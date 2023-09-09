<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MembersMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 5,
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => '120',
                'nullable'          => true
            ],
            'email' => [
                'type'              => 'VARCHAR',
                'constraint'        => '120',
                'nullable'          => true
            ],
            'mobile' => [
                'type'              => 'VARCHAR',
                'constraint'        => '120',
                'nullable'          => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('members');
    }

    public function down()
    {
        $this->forge->dropTable('members');
    }
}
