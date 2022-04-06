<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbDetailTransaksi extends Migration
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
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'id_paket' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'qty' => [
                'type' => 'DOUBLE'
            ],
            'keterangan' => [
                'type' => 'text'
            ]
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_detail_transaksi', true);
    }

    public function down()
    {
        //
    }
}
