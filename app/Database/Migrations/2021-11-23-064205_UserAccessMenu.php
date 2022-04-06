<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAccessMenu extends Migration
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
            'role_id' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'menu_id' => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('user_access_menu', true);
    }

    public function down()
    {
        //
    }
}
