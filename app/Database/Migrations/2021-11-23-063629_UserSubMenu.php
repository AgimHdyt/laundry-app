<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSubMenu extends Migration
{
    public function up()
    {
        //
        // $this->forge->addField([
        //     'id' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11,
        //         'auto_increment' => true
        //     ],
        //     'menu_id' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11
        //     ],
        //     'title' => [
        //         'type'           => 'VARCHAR',
        //         'constraint'     => '50'
        //     ],
        //     'url' => [
        //         'type'           => 'VARCHAR',
        //         'constraint'     => '50'
        //     ],
        //     'icon' => [
        //         'type'           => 'VARCHAR',
        //         'constraint'     => '50'
        //     ],
        //     'is_active' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11
        //     ]
        // ]);

        // $this->forge->addPrimaryKey('id', true);
        // $this->forge->createTable('user_sub_menu', true);
    }

    public function down()
    {
        //
    }
}
