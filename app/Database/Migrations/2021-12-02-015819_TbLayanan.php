<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbLayanan extends Migration
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
            'nama_layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_layanan', true);
    }

    public function down()
    {
        //
        // $this->forge->dropTable('tb_layanan', true);
    }
}
