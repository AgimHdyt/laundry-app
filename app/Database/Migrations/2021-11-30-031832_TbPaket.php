<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbPaket extends Migration
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
            'id_outlet' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'jenis' => [
                'type' => 'ENUM("kiloan","selimut","bed_cover","kaos","lain")'
            ],
            'nama_paket' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_paket', true);
    }

    public function down()
    {
        //
    }
}
