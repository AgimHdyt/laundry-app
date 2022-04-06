<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserMenu extends Migration
{
    public function up()
    {
        //
        // Membuat table user menu
        // $this->forge->addField([
        //     'id' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11,
        //         'auto_increment' => true
        //     ],
        //     'menu' => [
        //         'type'           => 'VARCHAR',
        //         'constraint'     => '100'
        //     ]
        // ]);
        // $this->forge->addPrimaryKey('id', true);
        // $this->forge->createTable('user_menu', true);
    }

    public function down()
    {
        //
    }
}
