<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDetailLayanan extends Migration
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
            'id_layanan' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'layanan' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'estimasi_waktu' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'harga' => [
                'type' => 'INT',
                'constraint' => 11
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_d_layanan', true);
    }

    public function down()
    {
        //
        // $this->forge->dropTable('tb_d_layanan', true);
    }
}
