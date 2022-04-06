<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserToken extends Migration
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
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 200
            ],
            'token' => [
                'type'           => 'VARCHAR',
                'constraint'     => 300
            ],
            'created_at' => [
                'type'          => 'VARCHAR',
                'constraint'    => 200
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('user_token', true);
    }

    public function down()
    {
        //
        // $this->forge->dropTable('user_token', true);
    }
}
