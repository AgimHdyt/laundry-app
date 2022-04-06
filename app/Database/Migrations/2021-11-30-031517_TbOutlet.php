<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbOutlet extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'alamat' => [
                'type' => 'TEXT'
            ],
            'tlp' => [
                'type' => 'VARCHAR',
                'constraint' => 15
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_outlet', true);
    }

    public function down()
    {
        //
    }
}
