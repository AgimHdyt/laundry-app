<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRole extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'role' => [
                'type'           => 'VARCHAR',
                'constraint'     => '100'
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('user_role', true);
    }

    public function down()
    {
        //
    }
}
