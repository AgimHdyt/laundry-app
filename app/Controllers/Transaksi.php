<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

class Transaksi extends BaseController
{
    use ResponseTrait;
    protected $menuModel;
    protected $userModel;
    protected $validation;
    protected $time;
    protected $db;
    public function __construct()
    {
        $this->userModel    = new UserModel();
        $this->db           = \Config\Database::connect();
        $this->time         = new Time('now');
        $this->session      = session();
        $this->validation =  \Config\Services::validation();
    }
    public function index()
    {
        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_layanan`.`id` = 1 AND `tb_d_layanan`.`id` = 1";
        $tabelLayanan = $this->db->query($query)->getResultArray();
        $data = [
            'title' => 'Transaksi',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'member' => $this->db->table('tb_member')->get()->getResultArray(),
            'layanan' => $this->db->table('tb_layanan')->get()->getResultArray(),
            'tabel' => $tabelLayanan,
            'noInvoice' => $this->noInvoice()
        ];
        return view('transaksi/v_index', $data);
    }
    public function getJenisLayanan()
    {
        $id = $this->request->getVar('id');
        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id";

        $tabelLayanan = $this->db->query($query)->getRowArray();
        // echo json_encode($data);
        echo json_encode($tabelLayanan);
    }

    public function layananTable()
    {
        $id = $this->request->getVar('id');
        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_layanan`.`id` = $id";

        $tabelLayanan = $this->db->query($query)->getResultArray();
        echo json_encode($tabelLayanan);
    }

    public function getTanggal()
    {
        $date_th = $this->request->getVar('date_th');
        $id = $this->request->getVar('id');

        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id";
        $tabelLayanan = $this->db->query($query)->getRowArray();

        $estimasi_waktu = $tabelLayanan['estimasi_waktu'];
        $tanggal1  = strtotime($date_th);
        $tanggal2 = (60 * 60 * 24 * $estimasi_waktu);

        $diff   = $tanggal1 + $tanggal2;
        $date = date('Y-m-d', $diff);

        echo json_encode($date);
    }

    public function getHarga()
    {
        $kilo = $this->request->getVar('kilo');
        $id = $this->request->getVar('id');

        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_d_layanan`.`id` = $id";
        $tabelLayanan = $this->db->query($query)->getRowArray();
        if (!$kilo) {
            $kilo = 0;
        } else {
            $harga = $tabelLayanan['harga'];
        }

        $total = $harga * $kilo;

        echo json_encode($total);
    }
    public function dataTransaksi()
    {
        $data = [
            'title' => 'Data Transaksi',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'transaksi' => $this->db->table('tb_transaksi')->get()->getResultArray()
        ];
        return view('transaksi/v_data-transaksi', $data);
    }
    public function transaksiBaru()
    {

        if (!$this->validate([
            'id_member' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data Member Harus di Pilh Terlebih Dahulu.',
                ]
            ],
            'id_layanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih jenis layanan terlebih dahulu.',
                ]
            ],
            'berat' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Anda Harus memilih jenis layanan terlebih dahulu.',
                    'numeric' => 'Data yang dimasukan harus berupa angka.'
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih tanggal terlebih dahulu.',
                ]
            ],
            'status_bayar' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih salah satu Status Pembayaran.',
                ]
            ],
        ])) {
            return redirect()->to('/transaksi')->withInput();
        }
        $invoice = $this->request->getVar('invoice');
        $id_member = $this->request->getVar('id_member');
        $id_layanan = $this->request->getVar('id_layanan');
        $berat = $this->request->getVar('berat');
        $total_biaya = $this->request->getVar('total_biaya');
        $tanggal_mulai = $this->request->getVar('tanggal_mulai');
        $tanggal_selesai = $this->request->getVar('tanggal_selesai');
        $keterangan = $this->request->getVar('keterangan');
        $pembayaran = $this->request->getVar('status_bayar');
        $user = $this->userModel->getUserByEmail(session()->get('email'));
        $id_user = $user['id'];
        $data = [
            'invoice' => $invoice,
            'id_member' => $id_member,
            'id_layanan' => $id_layanan,
            'berat' => $berat,
            'total_biaya' => $total_biaya,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'keterangan' => $keterangan,
            'status' => 'Baru',
            'pembayaran' => $pembayaran,
            'id_user' => $id_user
        ];
        $this->db->table('tb_transaksi')->insert($data);
        $this->session->setFlashdata('success', 'Transaksi telah berhasil!');
        return redirect()->to('/data-transaksi');
    }

    public function detailTransaksi()
    {
        $invoice = $this->request->getVar('invoice');

        $data = [];
        $query = "SELECT `tb_layanan`.*, `tb_d_layanan` .*
        FROM `tb_layanan` JOIN `tb_d_layanan`
        ON `tb_layanan`.`id` = `tb_d_layanan`.`id_layanan` WHERE `tb_layanan`.`id` = 1 AND `tb_d_layanan`.`id` = 1";
        $tabelLayanan = $this->db->query($query)->getResultArray();

        $data = [
            'title' => 'Detail Transaksi',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'transaksi' => $this->db->table('tb_transaksi')->getWhere(['invoice' => $invoice])->getRowArray(),
            'pelanggan' => $this->db->table('tb_member')->get()->getResultArray(),
            'jenis' => $this->db->table('tb_layanan')->get()->getResultArray(),
            'tabel' => $tabelLayanan,
            'noInvoice' => $this->noInvoice()
        ];
        return view('transaksi/v_detail-transaksi', $data);
    }

    public function getTransaksiById()
    {
        $id = $this->request->getVar('id');
        $query = $this->db->table('tb_transaksi')->getWhere(['id' => $id])->getRowArray();
        echo json_encode($query);
    }

    public function editTransaksi()
    {
        if (!$this->validate([
            'id_member' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Data Member Harus di Pilh Terlebih Dahulu.',
                ]
            ],
            'id_layanan' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih jenis layanan terlebih dahulu.',
                ]
            ],
            'berat' => [
                'rules' => 'required|trim|numeric',
                'errors' => [
                    'required' => 'Anda Harus memilih jenis layanan terlebih dahulu.',
                    'numeric' => 'Data yang dimasukan harus berupa angka.'
                ]
            ],
            'tanggal_mulai' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih tanggal terlebih dahulu.',
                ]
            ],
            'status_bayar' => [
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Anda Harus memilih salah satu Status Pembayaran.',
                ]
            ],
        ])) {
            return redirect()->to('/transaksi')->withInput();
        }
        $invoice = $this->request->getVar('invoice');
        $id_member = $this->request->getVar('id_member');
        $id_layanan = $this->request->getVar('id_layanan');
        $berat = $this->request->getVar('berat');
        $total_biaya = $this->request->getVar('total_biaya');
        $tanggal_mulai = $this->request->getVar('tanggal_mulai');
        $tanggal_selesai = $this->request->getVar('tanggal_selesai');
        $keterangan = $this->request->getVar('keterangan');
        $pembayaran = $this->request->getVar('status_bayar');
        $status = $this->request->getVar('status');
        $user = $this->userModel->getUserByEmail(session()->get('email'));
        $id_user = $user['id'];
        $update = [
            'invoice' => $invoice,
            'id_member' => $id_member,
            'id_layanan' => $id_layanan,
            'berat' => $berat,
            'total_biaya' => $total_biaya,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'keterangan' => $keterangan,
            'status' => $status,
            'pembayaran' => $pembayaran,
            'id_user' => $id_user
        ];
        $this->db->table('tb_transaksi')->where(['invoice' => $invoice])->update($update);
        $this->session->setFlashdata('success', 'Transaksi telah diubah!');
        return redirect()->to('/data-transaksi');
    }

    public function cetakPDF()
    {
        $invoice = $this->request->getVar('invoice');
        $data = [
            'title' => 'Cetak PDF',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'transaksi' => $this->db->table('tb_transaksi')->getWhere(['invoice' => $invoice])->getRowArray()
        ];
        return view('transaksi/cetak-pdf', $data);
    }

    public function cetakThermal()
    {
        $invoice = $this->request->getVar('invoice');
        $data = [
            'title' => 'Cetak Thermal',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'transaksi' => $this->db->table('tb_transaksi')->getWhere(['invoice' => $invoice])->getRowArray()
        ];
        return view('transaksi/cetak-thermal', $data);
    }

    public function cetak()
    {
    }

    public function printPdf()
    {
        $invoice = $this->request->getVar('invoice');
        $data = [
            'title' => 'Laporan Transaksi',
            'validation' => $this->validation,
            'user' => $this->userModel->getUserByEmail(session()->get('email')),
            'transaksi' => $this->db->table('tb_transaksi')->getWhere(['invoice' => $invoice])->getRowArray()
        ];

        // return view('transaksi/print-pdf', $data);
        $dompdf = new \Dompdf\Dompdf();
        $html = view('transaksi/print-pdf', $data);
        $dompdf->loadHtml($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $dompdf->setPaper('A4', 'portrait'); //ukuran kertas dan orientasi
        $dompdf->render();
        $dompdf->stream("laporan-transaksi"); //nama file pdf


    }

    public function noInvoice()
    {
        $query = "SELECT max(invoice) AS invoice FROM tb_transaksi";
        $data = $this->db->query($query)->getRowArray();
        $nomer = $data['invoice'];
        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($nomer, 3, 3);

        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "BRG";
        $invoice = $huruf . sprintf("%03s", $urutan);
        return $invoice;
    }
}
