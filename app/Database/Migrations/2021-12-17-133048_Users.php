<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        //
        // Membuat kolom/field untuk tabel news
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'email'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 300,
            ],
            'image'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 200,
            ],
            'role_id'      => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
            ],
            'is_active'      => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
            ],
            'created_at'      => [
                'type'           => 'VARCHAR',
                'constraint'     => 300,
            ]
        ]);

        // Membuat primary key
        $this->forge->addPrimaryKey('id', TRUE);
        $this->forge->addUniqueKey('email', TRUE);

        // Membuat tabel news
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        //
    }
}
