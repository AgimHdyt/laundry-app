<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TbTransaksi extends Migration
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
            'id_outlet' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'kode_invoice' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100
            ],
            'id_member' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'tgl DATETIME DEFAULT CURRENT_TIMESTAMP',
            'batas_waktu DATETIME DEFAULT CURRENT_TIMESTAMP',
            'tgl_bayar DATETIME DEFAULT CURRENT_TIMESTAMP',
            'biaya_tambahan' => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'diskon DOUBLE',
            'pajak' => [
                'type'  => 'INT',
                'constraint' => 11
            ],
            'status' => [
                'type'  => 'ENUM("Baru","Proses","Selesai","Diambil")'
            ],
            'dibayar' => [
                'type'  => 'ENUM("Di Bayar","Belum Dibayar")'
            ],
            'id_user' => [
                'type'  => 'INT',
                'constraint' => 11
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('tb_transaksi', true);
    }

    public function down()
    {
        //
    }
}
